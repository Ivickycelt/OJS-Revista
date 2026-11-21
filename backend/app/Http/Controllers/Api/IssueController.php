<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IssueResource;
use App\Models\Issue;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IssueController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $numeros = Issue::withCount('articles')
            ->orderByDesc('year')
            ->orderByDesc('number')
            ->get();

        return IssueResource::collection($numeros);
    }

    public function show(Issue $issue): IssueResource
    {
        $issue->load([
            'articles' => fn ($consulta) => $consulta
                ->where('is_published', true)
                ->orderBy('start_page'),
            'articles.authors',
            'articles.section',
        ]);

        return new IssueResource($issue);
    }
}
