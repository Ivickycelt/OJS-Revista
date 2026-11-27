<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(JournalSeeder::class);

        // ---- Usuarios de demostración ----
        // Las contraseñas se leen de .env (DEMO_ADMIN_PASSWORD, DEMO_LECTOR_PASSWORD).
        // Si no existen, se genera una aleatoria y se muestra en consola (solo esta vez).
        $passAdmin = env('DEMO_ADMIN_PASSWORD') ?: Str::random(16);
        $passLector = env('DEMO_LECTOR_PASSWORD') ?: Str::random(16);
        if (! env('DEMO_ADMIN_PASSWORD') || ! env('DEMO_LECTOR_PASSWORD')) {
            $this->command?->warn("Contraseñas de demo generadas: admin@sancolfr.test = {$passAdmin} | lector@sancolfr.test = {$passLector}");
        }

        User::updateOrCreate(
            ['email' => 'admin@sancolfr.test'],
            [
                'name' => 'Administrador',
                'password' => $passAdmin,
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'lector@sancolfr.test'],
            [
                'name' => 'Lector de prueba',
                'password' => $passLector,
                'role' => 'lector',
                'email_verified_at' => now(),
            ]
        );
    }
}
