<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;

class ArticleController extends Controller
{
    /**
     * Lista de artículos con filtros opcionales:
     * ?search=texto  ?section=slug  ?issue=id
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $consulta = Article::with(['authors', 'section', 'issue.journal'])
            ->where('is_published', true);

        if ($request->filled('section')) {
            $slug = $request->input('section');
            $consulta->whereHas('section', fn ($q) => $q->where('slug', $slug));
        }

        if ($request->filled('journal')) {
            $revista = $request->input('journal');
            $consulta->whereHas('issue.journal', fn ($q) => $q->where('slug', $revista));
        }

        if ($request->filled('issue')) {
            $consulta->where('issue_id', (int) $request->input('issue'));
        }

        if ($request->filled('search')) {
            $texto = (string) $request->input('search');
            $consulta->where(function ($q) use ($texto) {
                $q->where('title', 'like', '%' . $texto . '%')
                    ->orWhereHas('authors', fn ($a) => $a->where('name', 'like', '%' . $texto . '%'));
            });
        }

        $articulos = $consulta
            ->orderByDesc('issue_id')
            ->orderBy('start_page')
            ->paginate(10);

        return ArticleResource::collection($articulos);
    }

    public function show(Article $article): ArticleResource
    {
        abort_unless($article->is_published, 404);

        $article->load(['authors', 'section', 'issue.journal']);

        return new ArticleResource($article);
    }

    // ---------- Solo administradores (ver routes/api.php) ----------

    public function store(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'issue_id' => ['required', 'exists:issues,id'],
            'section_id' => ['required', 'exists:sections,id'],
            'title' => ['required', 'string', 'max:255'],
            'abstract' => ['nullable', 'string'],
            'start_page' => ['nullable', 'integer', 'min:1'],
            'pdf_url' => ['nullable', 'url', 'max:2048'],
            'authors' => ['required', 'array', 'min:1'],
            'authors.*' => ['string', 'max:255'],
        ]);

        $articulo = Article::create(Arr::except($datos, 'authors'));
        $this->guardarAutores($articulo, $datos['authors']);
        $articulo->load(['authors', 'section', 'issue.journal']);

        return (new ArticleResource($articulo))->response()->setStatusCode(201);
    }

    public function update(Request $request, Article $article): ArticleResource
    {
        $datos = $request->validate([
            'issue_id' => ['sometimes', 'exists:issues,id'],
            'section_id' => ['sometimes', 'exists:sections,id'],
            'title' => ['sometimes', 'string', 'max:255'],
            'abstract' => ['nullable', 'string'],
            'start_page' => ['nullable', 'integer', 'min:1'],
            'pdf_url' => ['nullable', 'url', 'max:2048'],
            'is_published' => ['sometimes', 'boolean'],
            'authors' => ['sometimes', 'array', 'min:1'],
            'authors.*' => ['string', 'max:255'],
        ]);

        $article->update(Arr::except($datos, 'authors'));

        if (isset($datos['authors'])) {
            $this->guardarAutores($article, $datos['authors']);
        }

        $article->load(['authors', 'section', 'issue.journal']);

        return new ArticleResource($article);
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return response()->noContent();
    }

    private function guardarAutores(Article $articulo, array $nombres): void
    {
        $ids = [];

        foreach (array_values($nombres) as $indice => $nombre) {
            $autor = Author::firstOrCreate(['name' => trim($nombre)]);
            $ids[$autor->id] = ['position' => $indice + 1];
        }

        $articulo->authors()->sync($ids);
    }
}
