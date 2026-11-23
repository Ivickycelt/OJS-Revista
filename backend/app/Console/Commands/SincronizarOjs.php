<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Author;
use App\Models\Issue;
use App\Models\Journal;
use App\Models\Section;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SincronizarOjs extends Command
{
    protected $signature = 'ojs:sincronizar {--url=http://localhost/ojs/index.php/horizontes/es/oai}';

    protected $description = 'Importa los artículos publicados en OJS (OAI-PMH) al portal';

    public function handle(): int
    {
        $url = $this->option('url');

        // Revista a la que pertenecen los números y artículos importados
        $revista = Journal::where('slug', 'horizontes')->firstOrFail();

        $numero = Issue::updateOrCreate(
            ['journal_id' => $revista->id, 'year' => 2026, 'number' => 1],
            ['volume' => 1, 'published_at' => '2026-06-19']
        );

        $seccion = Section::where('journal_id', $revista->id)
            ->where('slug', 'articulos-originales')
            ->firstOrFail();

        $respuesta = Http::timeout(20)->get($url, [
            'verb' => 'ListRecords',
            'metadataPrefix' => 'oai_dc',
        ]);

        if (! $respuesta->successful()) {
            $this->error('No se pudo conectar con OJS. Revisa que XAMPP y Apache estén encendidos.');
            return self::FAILURE;
        }

        $xml = simplexml_load_string($respuesta->body());
        if ($xml === false) {
            $this->error('OJS respondió algo que no es XML válido.');
            return self::FAILURE;
        }

        $xml->registerXPathNamespace('oai', 'http://www.openarchives.org/OAI/2.0/');
        $registros = $xml->xpath('//oai:record') ?: [];

        if (empty($registros)) {
            $this->warn('OJS no tiene artículos publicados todavía.');
            return self::SUCCESS;
        }

        $importados = 0;

        foreach ($registros as $registro) {
            $titulos = $this->valores($registro, './/dc:title');
            $titulo = $titulos[0] ?? '';

            if ($titulo === '') {
                continue;
            }

            $resumen = $this->valores($registro, './/dc:description')[0] ?? null;

            $articulo = Article::updateOrCreate(
                ['issue_id' => $numero->id, 'title' => $titulo],
                [
                    'section_id' => $this->seccionDeOjs($registro, $revista)->id,
                    'abstract' => $resumen,
                    'is_published' => true,
                ]
            );

            // Autores en el mismo orden en que OJS los publicó
            $autores = [];
            foreach ($this->valores($registro, './/dc:creator') as $posicion => $nombre) {
                $autor = Author::firstOrCreate(['name' => $nombre]);
                $autores[$autor->id] = ['position' => $posicion + 1];
            }
            $articulo->authors()->sync($autores);

            $importados++;
        }

        $this->info("Artículos importados desde OJS: {$importados}");

        return self::SUCCESS;
    }

    // Códigos de sección que OJS envía en el setSpec (p. ej. horizontes:EDIT)
    private const CODIGOS_SECCION = [
        'EDIT' => 'editorial',
        'COM' => 'comunicacion-breve',
        'ORIG' => 'articulos-originales',
        'REV' => 'articulo-de-revision',
        'TES' => 'tesis-de-egresados',
    ];

    // Usa la sección que OJS asignó al artículo; si no la reconoce, usa "Artículos originales".
    private function seccionDeOjs(\SimpleXMLElement $registro, Journal $revista): Section
    {
        $registro->registerXPathNamespace('oai', 'http://www.openarchives.org/OAI/2.0/');

        foreach ($registro->xpath('./oai:header/oai:setSpec') ?: [] as $codigo) {
            $partes = explode(':', (string) $codigo);
            $slug = self::CODIGOS_SECCION[$partes[1] ?? ''] ?? null;

            if ($slug !== null) {
                return Section::where('journal_id', $revista->id)->where('slug', $slug)->firstOrFail();
            }
        }

        return Section::where('journal_id', $revista->id)
            ->where('slug', 'articulos-originales')
            ->firstOrFail();
    }

    // Devuelve todos los valores de un campo Dublin Core, sin espacios sobrantes.
    private function valores(\SimpleXMLElement $nodo, string $ruta): array
    {
        $nodo->registerXPathNamespace('oai', 'http://www.openarchives.org/OAI/2.0/');
        $nodo->registerXPathNamespace('dc', 'http://purl.org/dc/elements/1.1/');

        $encontrados = $nodo->xpath($ruta) ?: [];

        return array_values(array_filter(
            array_map(fn ($n) => trim((string) $n), $encontrados),
            fn ($texto) => $texto !== ''
        ));
    }
}