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
            'start_page' => $this->start_page,
            'pdf_url' => $this->pdf_url,
            'is_published' => $this->is_published,
            'section' => new SectionResource($this->whenLoaded('section')),
            'issue' => new IssueResource($this->whenLoaded('issue')),
            'authors' => $this->whenLoaded('authors', fn () => $this->authors->pluck('name')),
        ];
    }
}
