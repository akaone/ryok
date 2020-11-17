<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->timestamps();

            $table->longText('deep_link_url')->nullable();
            $table->longText('qr_code')->nullable();
            $table->string('product_description')->nullable();

            $table->string('amount_requested');
            $table->string('curerncy_requested');
            $table->string('amount_used')->nullable();;
            $table->string('curerncy_used')->nullable();

            $table->string('exchange_rate')->nullable();

            $table->boolean('live')->default(false);

            $table->enum('state', ['CREATED', 'PAID', 'FAILLED', 'EXPIRED'])->default('CREATED');

            $table->string('country_prefix')->nullable();
            $table->string('phone_number')->nullable();
            $table->longText('carrier_response_ussd')->nullable();
            $table->longText('carrier_response_sms')->nullable();

            $table->string('app_id');
            $table->foreign('app_id')
                ->references('id')->on('apps')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->string('client_id')->nullable();
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
        Schema::dropIfExists('operations');
    }
}
