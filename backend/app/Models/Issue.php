<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Issue extends Model
{
    protected $fillable = ['volume', 'number', 'year', 'title', 'published_at'];

    protected function casts(): array
    {
        return ['published_at' => 'date'];
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
