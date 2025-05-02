<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('scenes', function (Blueprint $table) {
            $table->string('chapter_key')->nullable()->after('story_id'); // глава
            $table->string('branch')->nullable()->after('chapter_key');   // ветка
            $table->unsignedInteger('number')->nullable()->after('branch'); // номер в ветке

            $table->string('choice_1_target_code')->nullable()->after('choice_1_text');
            $table->string('choice_2_target_code')->nullable()->after('choice_2_text');
        });
    }

    public function down(): void
    {
        Schema::table('scenes', function (Blueprint $table) {
            $table->dropColumn([
                'chapter_key',
                'branch',
                'number',
                'choice_1_target_code',
                'choice_2_target_code',
            ]);
        });
    }
};
