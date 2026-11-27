<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Issue;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Solo administradores (ver EnsureUserIsAdmin en routes/api.php).
class AdminController extends Controller
{
    public function metricas(): JsonResponse
    {
        $ultimos = Article::with(['issue.journal', 'section'])
            ->latest('id')
            ->limit(5)
            ->get()
            ->map(fn (Article $articulo) => [
                'id' => $articulo->id,
                'title' => $articulo->title,
                'revista' => $articulo->issue?->journal?->name,
                'seccion' => $articulo->section?->name,
                'publicado' => (bool) $articulo->is_published,
            ]);

        return response()->json([
            'totales' => [
                'revistas' => Journal::count(),
                'numeros' => Issue::count(),
                'articulos' => Article::count(),
                'articulos_publicados' => Article::where('is_published', true)->count(),
                'usuarios' => User::count(),
                'favoritos' => (int) User::withCount('favorites')->get()->sum('favorites_count'),
            ],
            'ultimos_articulos' => $ultimos,
        ]);
    }

    // Lee el archivo storage/logs/laravel.log y devuelve las entradas más recientes.
    public function logs(Request $request): JsonResponse
    {
        $limite = min(max((int) $request->input('limite', 100), 1), 500);
        $nivel = strtoupper((string) $request->input('nivel', ''));
        $ruta = storage_path('logs/laravel.log');

        if (! is_file($ruta)) {
            return response()->json(['data' => [], 'archivo' => 'laravel.log']);
        }

        $tamano = (int) filesize($ruta);
        $contenido = (string) file_get_contents($ruta, false, null, max(0, $tamano - 524288));

        preg_match_all(
            '/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] \S+?\.(\w+): (.*?)(?=^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]|\z)/ms',
            $contenido,
            $coincidencias,
            PREG_SET_ORDER
        );

        $entradas = collect($coincidencias)
            ->map(fn ($c) => [
                'fecha' => $c[1],
                'nivel' => strtoupper($c[2]),
                'mensaje' => mb_substr(trim($c[3]), 0, 2000),
            ])
            ->when($nivel !== '', fn ($coleccion) => $coleccion->where('nivel', $nivel))
            ->reverse()
            ->take($limite)
            ->values();

        return response()->json(['data' => $entradas, 'archivo' => 'laravel.log']);
    }
}
