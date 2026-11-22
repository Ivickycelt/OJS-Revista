<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Author;
use App\Models\Issue;
use App\Models\Section;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SincronizarOjs extends Command
{
    protected $signature = 'ojs:sincronizar {--url=http://localhost/ojs/index.php/horizontes/es/oai}';

    protected $description = 'Trae los artículos publicados en OJS (OAI-PMH) y los guarda en el portal';

    public function handle(): int
    {
        $respuesta = Http::timeout(20)->get($this->option('url'), [
            'verb' => 'ListRecords',
            'metadataPrefix' => 'oai_dc',
        ]);

        if (! $respuesta->successful()) {
            $this->error('OJS no respondió. Revisa la URL y que Apache esté encendido.');

            return self::FAILURE;
        }

        $xml = @simplexml_load_string($respuesta->body());

        if ($xml === false) {
            $this->warn('OJS respondió, pero sin artículos publicados todavía.');

            return self::SUCCESS;
        }

        $xml->registerXPathNamespace('oai', 'http://www.openarchives.org/OAI/2.0/');

        $registros = $xml->xpath('//oai:record') ?: [];

        if (count($registros) === 0) {
            $this->warn('OJS respondió, pero no hay artículos publicados todavía.');

            return self::SUCCESS;
        }

        $numero = Issue::firstOrCreate(
            ['volume' => 1, 'number' => 1, 'year' => 2026],
            ['title' => 'Enero-junio de 2026', 'published_at' => '2026-06-19']
        );

        $seccion = Section::where('slug', 'articulos-originales')->firstOrFail();
        $nuevos = 0;

        foreach ($registros as $registro) {
            $registro->registerXPathNamespace('dc', 'http://purl.org/dc/elements/1.1/');

            $titulo = trim((string) ($registro->xpath('.//dc:title')[0] ?? ''));

            if ($titulo === '') {
                continue;
            }

            $resumen = trim((string) ($registro->xpath('.//dc:description')[0] ?? ''));
            $autores = array_map('trim', array_map('strval', $registro->xpath('.//dc:creator') ?: []));

            $articulo = Article::updateOrCreate(
                ['title' => $titulo, 'issue_id' => $numero->id],
                [
                    'section_id' => $seccion->id,
                    'abstract' => $resumen ?: null,
                    'is_published' => true,
                ]
            );

            $ids = [];
            foreach ($autores as $indice => $nombre) {
                if ($nombre === '') {
                    continue;
                }
                $autor = Author::firstOrCreate(['name' => $nombre]);
                $ids[$autor->id] = ['position' => $indice + 1];
            }
            $articulo->authors()->sync($ids);

            $nuevos++;
        }

        $this->info("Sincronización lista: {$nuevos} artículo(s) traídos de OJS.");

        return self::SUCCESS;
    }
}