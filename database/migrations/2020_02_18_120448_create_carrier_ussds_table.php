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
            
            # infos to execute on the client phone side
            $table->string('client_ussd_format')->nullable();
            $table->string('client_ussd_amount_regex')->nullable();
            $table->string('client_ussd_reference_regex')->nullable();
            $table->string('client_sms_amount_regex')->nullable();
            $table->string('client_sms_reference_regex')->nullable();

            # infos to execute on the merchant sim side
            $table->string('merchant_ussd_format')->nullable();
            $table->string('merchant_ussd_amount_regex')->nullable();
            $table->string('merchant_ussd_reference_regex')->nullable();
            $table->string('merchant_sms_amount_regex')->nullable();
            $table->string('merchant_sms_reference_regex')->nullable();

            # 
            $table->string('received_transfert_sms_amount_regex')->nullable();
            $table->string('received_transfert_sms_reference_regex')->nullable();

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
