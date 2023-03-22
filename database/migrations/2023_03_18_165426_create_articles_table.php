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
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('abstract');
            $table->string('authors_name');
            $table->string('no_page');
            $table->string('authors_email');
            $table->mediumText('keywords');
            $table->string('attachment');
            $table->date('accepted')->nullable();
            $table->boolean('status');
            $table->date('received')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->json('other_authors_name')->nullable();
            $table->json('other_authors_email')->nullable();
            $table->foreignUuid('journal_id')->references('id')->on('journals');

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
        Schema::dropIfExists('articles');
    }
};