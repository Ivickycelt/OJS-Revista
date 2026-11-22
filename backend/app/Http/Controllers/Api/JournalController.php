<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IssueResource;
use App\Http\Resources\JournalResource;
use App\Http\Resources\SectionResource;
use App\Models\Issue;
use App\Models\Journal;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class JournalController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $revistas = Journal::withCount('issues')->orderBy('name')->get();

        return JournalResource::collection($revistas);
    }

    public function show(Journal $journal): JournalResource
    {
        $journal->loadCount('issues');

        return new JournalResource($journal);
    }

    public function sections(Journal $journal): AnonymousResourceCollection
    {
        return SectionResource::collection($journal->sections);
    }

    public function issues(Journal $journal): AnonymousResourceCollection
    {
        $numeros = $journal->issues()->withCount('articles')->get();

        return IssueResource::collection($numeros);
    }

    // Con scopeBindings(), el número debe pertenecer a esa revista.
    public function issue(Journal $journal, Issue $issue): IssueResource
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
