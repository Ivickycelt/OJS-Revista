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
    protected $signature = 'ojs:sincronizar
        {revista=academica-abierta : Ruta (slug) de la revista, igual en OJS y en el portal}
        {--url= : Dirección OAI-PMH de OJS (si no se indica, se arma con la ruta de la revista)}
        {--anio=2026 : Año del número donde se guardan los artículos}
        {--numero=1 : Número donde se guardan los artículos}
        {--volumen=1 : Volumen del número}';

    protected $description = 'Importa los artículos publicados en OJS (OAI-PMH) al portal';

    // Secciones de la revista. La clave es la abreviatura de la sección en OJS,
    // que OJS envía en el setSpec (por ejemplo, academica-abierta:ORIG).
    private const SECCIONES = [
        'ORIG' => ['slug' => 'articulos-originales', 'nombre' => 'Artículos originales'],
        'REV' => ['slug' => 'articulos-de-revision', 'nombre' => 'Artículos de revisión'],
        'ENS' => ['slug' => 'ensayos', 'nombre' => 'Ensayos'],
        'RES' => ['slug' => 'resenas', 'nombre' => 'Reseñas'],
        'EDIT' => ['slug' => 'editorial', 'nombre' => 'Editorial'],
        'COM' => ['slug' => 'comunicaciones-breves', 'nombre' => 'Comunicaciones breves'],
    ];

    // Si OJS no envía una sección reconocida, el artículo va a esta.
    private const SECCION_PREDETERMINADA = 'ORIG';

    public function handle(): int
    {
        $slug = $this->argument('revista');
        $url = $this->option('url') ?: "http://localhost/ojs/index.php/{$slug}/es/oai";

        $revista = Journal::where('slug', $slug)->first();
        if (! $revista) {
            $this->error("No existe la revista '{$slug}' en el portal. Créala primero (ver docs/revista-nueva.md).");
            return self::FAILURE;
        }

        // Número donde se guardan los artículos importados
        $numero = Issue::firstOrCreate(
            [
                'journal_id' => $revista->id,
                'year' => (int) $this->option('anio'),
                'number' => (int) $this->option('numero'),
            ],
            [
                'volume' => (int) $this->option('volumen'),
                'published_at' => now()->toDateString(),
            ]
        );

        $secciones = $this->asegurarSecciones($revista);

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
                    'section_id' => $this->seccionDeOjs($registro, $secciones)->id,
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

    // Crea en el portal las secciones que falten para esta revista y las devuelve por código.
    private function asegurarSecciones(Journal $revista): array
    {
        $mapa = [];
        foreach (self::SECCIONES as $codigo => $dato) {
            $mapa[$codigo] = Section::firstOrCreate(
                ['journal_id' => $revista->id, 'slug' => $dato['slug']],
                ['name' => $dato['nombre'], 'position' => count($mapa) + 1]
            );
        }

        return $mapa;
    }

    // Usa la sección que OJS asignó al artículo; si no la reconoce, usa la predeterminada.
    private function seccionDeOjs(\SimpleXMLElement $registro, array $secciones): Section
    {
        $registro->registerXPathNamespace('oai', 'http://www.openarchives.org/OAI/2.0/');

        foreach ($registro->xpath('./oai:header/oai:setSpec') ?: [] as $codigo) {
            $partes = explode(':', (string) $codigo);
            $clave = $partes[1] ?? '';

            if (isset($secciones[$clave])) {
                return $secciones[$clave];
            }
        }

        return $secciones[self::SECCION_PREDETERMINADA];
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
