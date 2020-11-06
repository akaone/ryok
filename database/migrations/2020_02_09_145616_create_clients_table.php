<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->timestamps();

            $table->string('calling_code')->nullable();
            $table->string('phone_number')->nullable();

            $table->string('fcm')->nullable();
            $table->string('jwt');

            $table->enum('state', ['SMS', 'ACTIVATED', 'DEACTIVATED'])->default('SMS');
            $table->text('state_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
