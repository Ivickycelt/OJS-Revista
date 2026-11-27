<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

// Da el rol de administrador a un usuario ya registrado.
// Se hace desde la terminal para que nadie pueda autoasignarse el rol desde la web.
class AsignarAdmin extends Command
{
    protected $signature = 'usuario:admin {correo : Correo del usuario que será administrador}';

    protected $description = 'Da el rol de administrador a un usuario registrado';

    public function handle(): int
    {
        $correo = (string) $this->argument('correo');
        $usuario = User::where('email', $correo)->first();

        if (! $usuario) {
            $this->error("No existe un usuario con el correo {$correo}. Regístrate primero en el portal.");

            return self::FAILURE;
        }

        // 'role' no está en $fillable, así que se fuerza a propósito.
        $usuario->forceFill(['role' => 'admin'])->save();

        $this->info("{$usuario->name} ahora es administrador. Cierra sesión y vuelve a entrar en el portal.");

        return self::SUCCESS;
    }
}
