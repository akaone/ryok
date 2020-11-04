<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carriers', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->timestamps();

            $table->string('name');
            $table->string('ibm')->unique();
            $table->string('country');

            $table->string('phone_regex');

            $table->boolean('is_api')->default(false);
            
            $table->enum('state', ['NOTVISIBLE', 'ACTIVATED', 'DEACTIVATED', 'DELETED'])->default('NOTVISIBLE');
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
        Schema::dropIfExists('carriers');
    }
}
