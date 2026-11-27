<?php

namespace Database\Seeders;

use App\Models\Journal;
use Illuminate\Database\Seeder;

class JournalSeeder extends Seeder
{
    // Revista de demostración de la plataforma SanColFr.
    // Las secciones tienen los mismos slugs que usa `ojs:sincronizar`.
    private const SECCIONES = [
        ['slug' => 'articulos-originales', 'nombre' => 'Artículos originales'],
        ['slug' => 'articulos-de-revision', 'nombre' => 'Artículos de revisión'],
        ['slug' => 'ensayos', 'nombre' => 'Ensayos'],
        ['slug' => 'resenas', 'nombre' => 'Reseñas'],
        ['slug' => 'editorial', 'nombre' => 'Editorial'],
        ['slug' => 'comunicaciones-breves', 'nombre' => 'Comunicaciones breves'],
    ];

    public function run(): void
    {
        $revista = Journal::updateOrCreate(
            ['slug' => 'academica-abierta'],
            [
                'name' => 'Revista Académica Abierta',
                'abbreviation' => 'RAA',
                'country' => 'México',
                'description' => 'Revista académica de acceso abierto para artículos originales, ensayos, reseñas y comunicaciones.',
                'contact_email' => 'Postdanger61@gmail.com',
                'color' => '#1A44D8',
                'accent' => '#00A087',
            ]
        );

        foreach (self::SECCIONES as $posicion => $seccion) {
            $revista->sections()->updateOrCreate(
                ['slug' => $seccion['slug']],
                ['name' => $seccion['nombre'], 'position' => $posicion + 1]
            );
        }

        $this->command?->info('Revista lista: Revista Académica Abierta');
    }
}
