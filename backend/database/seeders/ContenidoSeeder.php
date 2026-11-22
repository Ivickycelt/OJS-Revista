<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ContenidoSeeder extends Seeder
{
    // Número => [título exacto en la base de datos, PDF individual del artículo]
    private array $articulos = [
        1 => ['Nacimiento de la revista "Horizontes"', 'horizontes-n1-1-nacimiento.pdf'],
        2 => ['Ética en el proceso de la publicación científica', 'horizontes-n1-2-etica.pdf'],
        3 => ['Caracterización de las variables económicas de las tecnologías de producción de la cebada en México', 'horizontes-n1-3-cebada.pdf'],
        4 => ['Análisis de la industria automotriz en América del Norte', 'horizontes-n1-4-automotriz.pdf'],
        5 => ['Lenguaje y realidad: una mirada inclusiva para la comunidad sorda', 'horizontes-n1-5-lenguaje-sordos.pdf'],
        6 => ['Un análisis exhaustivo del desempeño de los fondos de inversión en el mercado financiero mexicano (2010-2023)', 'horizontes-n1-6-fondos-inversion.pdf'],
        7 => ['Coordinación de especialidades para la optimización de interferencias BIM en despacho de ingeniería de instalaciones', 'horizontes-n1-7-bim.pdf'],
    ];

    public function run(): void
    {
        foreach ($this->articulos as $numero => [$titulo, $pdf]) {
            $ruta = database_path("contenido/{$numero}.txt");
            $texto = File::exists($ruta) ? trim(File::get($ruta)) : null;

            $filas = Article::where('title', $titulo)->update([
                'body' => $texto,
                'pdf_url' => '/pdf/' . $pdf,
            ]);

            $this->command?->info(($filas ? 'OK   ' : 'NO ENCONTRADO  ') . $titulo);
        }
    }
}
