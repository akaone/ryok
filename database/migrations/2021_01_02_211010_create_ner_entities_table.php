<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNerEntitiesTable extends Migration
{
    public function up()
    {
        Schema::create('ner_entities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('text')->nullable();
            $table->integer('start');
            $table->integer('end');
            $table->enum('label', ["CURRENCY", "AMOUNT", "REFERENCE"]);

            $table->unsignedBigInteger('ner_sentences_id');
            $table->foreign('ner_sentences_id')
                ->references('id')->on('ner_sentences')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ner_entities');
    }
}
