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
            $table->string('currency_requested');

            $table->string('amount_used')->nullable();
            $table->string('currency_used')->nullable();

            $table->string('exchange_rate')->nullable();

            $table->boolean('live')->default(false);

            $table->enum('state', ['SCAN', 'CREATED', 'PENDING', 'PAID', 'FAILED', 'EXPIRED'])->default('CREATED');

            $table->longText('ussd_response')->nullable();
            $table->longText('ussd_amount')->nullable();
            $table->longText('ussd_reference')->nullable();

            $table->longText('sms_response')->nullable();
            $table->longText('sms_amount')->nullable();
            $table->longText('sms_reference')->nullable();

            $table->string('previous_balance')->nullable();
            $table->string('balance')->nullable();


            $table->string('code')->nullable();

            $table->string('account_id')->nullable(); # phone number | account id
            $table->string('for_operation')->nullable();
            $table->string('from')->nullable(); # phone number | account id
            $table->string('to')->nullable();

            /**
             * FROM_CLIENT_MOBILE_MONEY_ACCOUNT
             * STEPS:
             *     1. from mobile money to client account
             *     2. from client account to app account
             *     3. from app account to ryok account (???)
             */

            /**
             * FROM_ACCOUNT_TO_MOBILE_MONEY
             * STEPS:
             *     1. from app account to mobile money number
             *     2. from app account to ryok account (???)
             */

            /**
             * MOBILE_MONEY_WITHDRAW_FROM_ACCOUNT
             * STEPS:
             *     1. from app account to mobile money number
             *     2. from app account to ryok account (???)
             */

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
