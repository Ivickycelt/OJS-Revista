<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Issue;
use App\Models\Journal;
use Illuminate\Http\JsonResponse;

// Resumen público para el dashboard de inicio del portal (no requiere sesión).
class ResumenController extends Controller
{
    public function index(): JsonResponse
    {
        $recientes = Article::with(['issue.journal', 'section'])
            ->where('is_published', true)
            ->latest('id')
            ->limit(6)
            ->get()
            ->map(fn (Article $articulo) => [
                'id' => $articulo->id,
                'title' => $articulo->title,
                'journal_slug' => $articulo->issue?->journal?->slug,
                'journal_name' => $articulo->issue?->journal?->name,
                'section' => $articulo->section?->name,
            ]);

        return response()->json([
            'totales' => [
                'revistas' => Journal::count(),
                'numeros' => Issue::count(),
                'articulos_publicados' => Article::where('is_published', true)->count(),
            ],
            'recientes' => $recientes,
        ]);
    }
}
