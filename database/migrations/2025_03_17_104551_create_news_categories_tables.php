<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('news_categories', function (Blueprint $table) {
            createDefaultTableFields($table);

            $table->integer('position')->unsigned()->nullable();
        });

        Schema::create('news_category_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'news_category');

            $table->string('title', 200)->nullable();
        });

        Schema::create('news_category_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'news_category');
        });

        Schema::create('news_category_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'news_category');
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_category_revisions');
        Schema::dropIfExists('news_category_translations');
        Schema::dropIfExists('news_category_slugs');
        Schema::dropIfExists('news_categories');
    }
};
