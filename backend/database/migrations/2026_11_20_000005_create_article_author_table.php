<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla intermedia: un artículo tiene varios autores y un autor varios artículos.
        Schema::create('article_author', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->foreignId('author_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('position')->default(1);

            $table->primary(['article_id', 'author_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_author');
    }
};
