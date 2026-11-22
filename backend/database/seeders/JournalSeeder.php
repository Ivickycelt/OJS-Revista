<?php

namespace Database\Seeders;

use App\Models\Issue;
use App\Models\Journal;
use App\Models\Section;
use Illuminate\Database\Seeder;

class JournalSeeder extends Seeder
{
    public function run(): void
    {
        $horizontes = Journal::updateOrCreate(
            ['slug' => 'horizontes'],
            [
                'name' => 'Horizontes',
                'abbreviation' => 'Horizontes',
                'issn' => '3122-4822',
                'publisher' => 'Colegio de Estudios de Postgrados Cuba–México',
                'country' => 'México',
                'description' => 'Revista de Ciencias del Colegio de Estudios de Postgrados Cuba-México. Publicación semestral de acceso abierto y sin cargos por procesamiento ni publicación.',
                'contact_email' => 'revistahorizontesuicm@gmail.com',
                'color' => '#006633',
                'accent' => '#f0ae5b',
            ]
        );

        // Números y secciones que ya existían pasan a ser de Horizontes.
        Issue::whereNull('journal_id')->update(['journal_id' => $horizontes->id]);
        Section::whereNull('journal_id')->update(['journal_id' => $horizontes->id]);

        $this->command?->info('Revista lista: Horizontes');
    }
}
