<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNerSentencesTable extends Migration
{
    public function up()
    {
        Schema::create('ner_sentences', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->longText('text');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ner_sentences');
    }
}
