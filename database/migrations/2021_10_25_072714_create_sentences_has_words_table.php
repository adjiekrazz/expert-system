<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentencesHasWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentences_has_words', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('word_id')->constrained('words');
            $table->unsignedBigInteger('sentence_id')->constrained('sentences');
            $table->integer('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sentences_has_words');
    }
}
