<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->year('release_year');
            $table->integer('genre_id')->unsigned();
            $table->string('country', 255);
            $table->string('director', 255);
            $table->time('duration');
            $table->text('actors');
            $table->decimal('price', 5, 0);
            $table->text('description');
            $table->string('cover', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
