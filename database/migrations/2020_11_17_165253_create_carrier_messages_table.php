<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrierMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrier_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('sender');
            $table->longText('body');

            $table->string('transaction_ref')->nullable();
            $table->string('transaction_amount')->nullable();

            $table->enum('state', ["PENDING", "TREATED"])->default("PENDING");

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
        Schema::dropIfExists('carrier_messages');
    }
}
