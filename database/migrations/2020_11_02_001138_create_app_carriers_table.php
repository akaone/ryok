<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppCarriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_carriers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('carrier_id');
            $table->foreign('carrier_id')
                ->references('id')->on('carriers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->boolean('activated');

            $table->string('app_id');
            $table->foreign('app_id')
                ->references('id')->on('apps')
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
        Schema::dropIfExists('app_carriers');
    }
}
