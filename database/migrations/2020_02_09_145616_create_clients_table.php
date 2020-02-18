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

            $table->string('email')->unique()->nullable();
            $table->string('email_slug')->unique()->nullable();
            $table->boolean('email_confirmed')->default(false);
            $table->string('password')->nullable();
            
            $table->enum('state', ['EMAIL', 'ACTIVATED', 'DEACTIVATED'])->default('EMAIL');
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
