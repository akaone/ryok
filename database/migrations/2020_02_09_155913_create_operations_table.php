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

            $TYPES = [
                "FROM_MOBILE_MONEY_TO_CLIENT_ACCOUNT",
                "FROM_CLIENT_ACCOUNT_TO_MOBILE_MONEY",
                "FROM_CLIENT_ACCOUNT_TO_APP_ACCOUNT",

                "FROM_APP_ACCOUNT_TO_MOBILE_MONEY",
                "FROM_APP_ACCOUNT_TO_RYOK_ACCOUNT",
                "FROM_APP_ACCOUNT_TO_CLIENT_ACCOUNT",

                "FROM_RYOK_ACCOUNT_TO_CLIENT_ACCOUNT",
                "FROM_RYOK_ACCOUNT_TO_MOBILE_MONEY"
            ];
            $table->enum('type', $TYPES);

            /**
             * FROM_MOBILE_MONEY_TO_CLIENT_ACCOUNT (client_deposit[free])
             * FROM_CLIENT_ACCOUNT_TO_MOBILE_MONEY (client_cash_out[free])
             * FROM_CLIENT_ACCOUNT_TO_APP_ACCOUNT (paying_goods[free])
             *
             * FROM_APP_ACCOUNT_TO_MOBILE_MONEY (withdraw[paid] | sending_out_money[paid])
             * FROM_APP_ACCOUNT_TO_RYOK_ACCOUNT (withdraw_fees[free] | sending_fees[free])
             * FROM_APP_ACCOUNT_TO_CLIENT_ACCOUNT (refund[paid] | sending_out_money[paid])
             *
             * FROM_RYOK_ACCOUNT_TO_CLIENT_ACCOUNT
             * FROM_RYOK_ACCOUNT_TO_MOBILE_MONEY
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
