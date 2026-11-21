<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FavoriteController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $articulos = $request->user()
            ->favorites()
            ->with(['authors', 'section', 'issue'])
            ->get();

        return ArticleResource::collection($articulos);
    }

    public function store(Request $request, Article $article): JsonResponse
    {
        // Cada usuario solo toca SUS favoritos (se usa $request->user()).
        $request->user()->favorites()->syncWithoutDetaching([$article->id]);

        return response()->json(['message' => 'Artículo agregado a favoritos.'], 201);
    }

    public function destroy(Request $request, Article $article): JsonResponse
    {
        $request->user()->favorites()->detach($article->id);

        return response()->json(['message' => 'Artículo quitado de favoritos.']);
    }
}
