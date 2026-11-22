<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JournalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'abbreviation' => $this->abbreviation,
            'issn' => $this->issn,
            'publisher' => $this->publisher,
            'country' => $this->country,
            'description' => $this->description,
            'contact_email' => $this->contact_email,
            'color' => $this->color,
            'accent' => $this->accent,
            'issues_count' => $this->whenCounted('issues'),
        ];
    }
}
