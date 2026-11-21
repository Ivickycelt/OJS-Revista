<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use App\Models\Issue;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Usuarios de demostración (cambiar las contraseñas en producción) ----
        User::forceCreate([
            'name' => 'Administrador',
            'email' => 'admin@horizontes.test',
            'password' => 'Admin1234!',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::forceCreate([
            'name' => 'Lector de prueba',
            'email' => 'lector@horizontes.test',
            'password' => 'Lector1234!',
            'role' => 'lector',
            'email_verified_at' => now(),
        ]);

        // ---- Secciones (las mismas que se configuraron en OJS) ----
        $sections = [];
        $nombres = [
            'editorial' => 'Editorial',
            'comunicacion-breve' => 'Comunicación breve',
            'articulos-originales' => 'Artículos originales',
            'articulo-de-revision' => 'Artículo de revisión',
            'tesis-de-egresados' => 'Tesis de egresados',
        ];
        $posicion = 1;
        foreach ($nombres as $slug => $nombre) {
            $sections[$slug] = Section::create([
                'name' => $nombre,
                'slug' => $slug,
                'position' => $posicion++,
            ]);
        }

        // ---- Número 1 de Horizontes (enero-junio 2026) ----
        $issue = Issue::create([
            'volume' => 1,
            'number' => 1,
            'year' => 2026,
            'title' => 'Enero-junio de 2026',
            'published_at' => '2026-06-19', // fecha de última modificación del PDF
        ]);

        // ---- Artículos del primer número (según su tabla de contenido) ----
        $articulos = [
            [
                'section' => 'editorial',
                'title' => 'Nacimiento de la revista "Horizontes"',
                'page' => 1,
                'authors' => ['Thailing Núñez Betancourt'],
            ],
            [
                'section' => 'comunicacion-breve',
                'title' => 'Ética en el proceso de la publicación científica',
                'page' => 2,
                'authors' => ['Iris Andrea Rojas Betancourt'],
            ],
            [
                'section' => 'articulos-originales',
                'title' => 'Caracterización de las variables económicas de las tecnologías de producción de la cebada en México',
                'page' => 8,
                'authors' => ['Ernest Yasser Núñez Betancourt', 'Ángel Martín Padrón Pérez', 'Carlos Ernesto Luquez Gaitán'],
            ],
            [
                'section' => 'articulos-originales',
                'title' => 'Análisis de la industria automotriz en América del Norte',
                'page' => 18,
                'authors' => ['Carlos Ernesto Luquez Gaitán', 'Ernest Yasser Núñez Betancourt', 'Natividad Hernández Mendoza', 'Javier Ortigoza Rufino'],
            ],
            [
                'section' => 'articulo-de-revision',
                'title' => 'Lenguaje y realidad: una mirada inclusiva para la comunidad sorda',
                'page' => 24,
                'authors' => ['Fleider Leiser Peña Escalona', 'Christian Alfredo Vázquez Cisneros', 'Roberto González Garduño'],
            ],
            [
                'section' => 'tesis-de-egresados',
                'title' => 'Un análisis exhaustivo del desempeño de los fondos de inversión en el mercado financiero mexicano (2010-2023)',
                'page' => 36,
                'authors' => ['Norma Alejandra Martínez Piñas', 'Rita Ávila Romero', 'Arianna Yanet Porcayo Albino'],
            ],
            [
                'section' => 'tesis-de-egresados',
                'title' => 'Coordinación de especialidades para la optimización de interferencias BIM en despacho de ingeniería de instalaciones',
                'page' => 46,
                'authors' => ['Luis Daniel Ramos Araizo'],
            ],
        ];

        foreach ($articulos as $datos) {
            $articulo = Article::create([
                'issue_id' => $issue->id,
                'section_id' => $sections[$datos['section']]->id,
                'title' => $datos['title'],
                'start_page' => $datos['page'],
            ]);

            foreach ($datos['authors'] as $indice => $nombre) {
                $autor = Author::firstOrCreate(['name' => $nombre]);
                $articulo->authors()->attach($autor->id, ['position' => $indice + 1]);
            }
        }
    }
}
