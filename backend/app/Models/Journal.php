<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Journal extends Model
{
    protected $fillable = [
        'name', 'slug', 'abbreviation', 'issn', 'publisher', 'country',
        'description', 'contact_email', 'color', 'accent',
    ];

    // En las direcciones se usa el slug: /api/revistas/horizontes
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class)->orderByDesc('year')->orderByDesc('number');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('position');
    }
}
