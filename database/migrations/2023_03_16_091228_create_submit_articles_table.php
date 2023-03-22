<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_articles', function (Blueprint $table) {
            $table->uuid('id')->unique()->index();
            $table->string('authors_name');
            $table->string('authors_email');
            $table->string('title_of_article');
            $table->string('country')->nullable();
            $table->string('article')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submit_articles');
    }
};
