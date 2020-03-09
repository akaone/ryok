<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrierUssdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrier_ussds', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->timestamps();
            
            $table->enum('state', ['ACTIVATED', 'DEACTIVATED'])->default('ACTIVATED');
            $table->string('ussd_regex')->nullable();
            $table->string('ussd_format')->nullable();
            $table->string('sms_format')->nullable();

            $table->string('carrier_id');
            $table->foreign('carrier_id')
                ->references('id')->on('carriers')
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
        Schema::dropIfExists('carrier_ussds');
    }
}
