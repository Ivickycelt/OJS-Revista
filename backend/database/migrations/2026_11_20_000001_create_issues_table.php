<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('volume')->default(1);
            $table->unsignedSmallInteger('number');
            $table->unsignedSmallInteger('year');
            $table->string('title')->nullable();
            $table->date('published_at')->nullable();
            $table->timestamps();

            $table->unique(['year', 'number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
