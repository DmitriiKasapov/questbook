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
        Schema::create('scenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained()->onDelete('cascade');
            $table->string('type')->default('main'); // main, branch, ending
            $table->text('content');
            $table->string('choice_1_text')->nullable();
            $table->unsignedBigInteger('choice_1_target_scene_id')->nullable();
            $table->string('choice_2_text')->nullable();
            $table->unsignedBigInteger('choice_2_target_scene_id')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scenes');
    }
};
