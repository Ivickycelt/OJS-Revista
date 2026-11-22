<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'abstract' => $this->abstract,
            'body' => $this->when($request->route('article') !== null, $this->body),
            'start_page' => $this->start_page,
            'journal_slug' => $this->issue?->journal?->slug,
            'journal_name' => $this->issue?->journal?->name,
            'pdf_url' => $this->pdf_url,
            'portada_url' => $this->pdf_url ? str_replace(['/pdf/', '.pdf'], ['/portadas/', '.png'], $this->pdf_url) : null,
            'is_published' => $this->is_published,
            'section' => new SectionResource($this->whenLoaded('section')),
            'issue' => new IssueResource($this->whenLoaded('issue')),
            'authors' => $this->whenLoaded('authors', fn () => $this->authors->pluck('name')),
        ];
    }
}
