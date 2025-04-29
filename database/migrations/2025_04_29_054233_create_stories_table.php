<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('stories', function (Blueprint $table) {
        $table->id();
        $table->string('title');          // Заголовок истории
        $table->text('description')->nullable(); // Описание
        $table->string('genre')->nullable(); // Жанр истории
        $table->string('cover_image')->nullable(); // Путь к обложке
        $table->boolean('is_published')->default(false); // Опубликована или нет
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};

