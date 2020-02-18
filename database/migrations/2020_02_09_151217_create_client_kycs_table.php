<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientKycsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_kycs', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->timestamps();

            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender', ['M', 'F'])->default('M')->nullable();
            $table->string('national_id_recto')->nullable();
            $table->string('national_id_verso')->nullable();

            $table->enum('state', ['PENDING', 'VALIDATED', 'REJECTED'])->default('PENDING');
            $table->text('state_reason')->nullable();

            $table->string('client_id');
            $table->foreign('client_id')
                ->references('id')->on('clients')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_kycs');
    }
}
