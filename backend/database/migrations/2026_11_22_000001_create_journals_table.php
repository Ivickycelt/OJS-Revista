<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('abbreviation')->nullable();
            $table->string('issn', 20)->nullable();
            $table->string('publisher')->nullable();
            $table->string('country')->default('México');
            $table->text('description')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('color', 7)->default('#006633');
            $table->string('accent', 7)->default('#f0ae5b');
            $table->timestamps();
        });

        // Cada número y cada sección pertenece a una revista.
        Schema::table('issues', function (Blueprint $table) {
            $table->foreignId('journal_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
            $table->dropUnique(['year', 'number']);
            $table->unique(['journal_id', 'year', 'number']);
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreignId('journal_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
            $table->dropUnique(['slug']);
            $table->unique(['journal_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropUnique(['journal_id', 'slug']);
            $table->dropConstrainedForeignId('journal_id');
            $table->unique('slug');
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->dropUnique(['journal_id', 'year', 'number']);
            $table->dropConstrainedForeignId('journal_id');
            $table->unique(['year', 'number']);
        });

        Schema::dropIfExists('journals');
    }
};
