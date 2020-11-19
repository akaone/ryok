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

            $table->string('country_code', 8)->nullable();
            $table->string('phone_number')->nullable();
            $table->unique(['country_code', 'phone_number']);
            $table->string('password')->nullable();

            $table->string('sms_code', 20)->nullable();

            $table->longText('fcm')->nullable();
            $table->longText('jwt')->nullable();

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
