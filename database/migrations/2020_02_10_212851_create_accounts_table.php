<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->timestamps();

            $table->string('name')->nullable();

            $table->string('client_id')->nullable();
            $table->string('app_id')->nullable();

            $table->string('country_prefix')->nullable();
            $table->string('phone_number')->nullable();

            $table->enum('type', ['CLIENT', 'APP', 'RYOK', 'LOYALTIES']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
