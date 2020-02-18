<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->timestamps();
            
            $table->string('amount');
            $table->string('curerncy');

            $table->string('debit_account');
            $table->foreign('debit_account')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->string('credit_account');
            $table->foreign('credit_account')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->string('operation_id');
            $table->foreign('operation_id')
                ->references('id')->on('operations')
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
        Schema::dropIfExists('transactions');
    }
}
