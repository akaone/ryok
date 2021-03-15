<?php

use App\Actions\Account\ApiAccountStats;
use App\Models\Account;
use App\Models\Client;
use App\Models\Operation;

test("accounts stats list a client deposits and spending grouped by week given a month", function () {
    # assert
    /** @var Client $client */
    $client = Client::factory([
        'country_code' => "228",
        'phone_number' => "91973610",
        'state' => Client::$STATE_ACTIVATED,
    ])->create();

    /** @var Account $clientAccount */
    $clientAccount = Account::factory(['client_id' => $client->id, 'type' => Account::$ACCOUNT_TYPE_CLIENT])->create();

    /** @var Account $appAccount */
    $appAccount = Account::factory(['type' => Account::$ACCOUNT_TYPE_APP])->create();

    Operation::factory([
        'from' => "22891973610", 'account_id' => $clientAccount->id,
        'amount_requested' => "600", 'currency_requested' => "XOF",
        'created_at' => \Carbon\Carbon::now()->startOfMonth()->addDays(2)
    ])->fromMobileMoneyToClientAccount()->create();
    Operation::factory([
        'from' => "22891973610", 'account_id' => $clientAccount->id,
        'amount_requested' => "2300", 'currency_requested' => "XOF",
        'created_at' => \Carbon\Carbon::now()->startOfMonth()->addDays(12)
    ])->fromMobileMoneyToClientAccount()->create();
    Operation::factory([
        'from' => $clientAccount->id, 'account_id' => $appAccount->id,
        'amount_requested' => "2300", 'currency_requested' => "XOF",
        'created_at' => \Carbon\Carbon::now()->startOfMonth()->addDays(12)
    ])->fromClientAccountToAppAccount()->create();

    # action
    $response = ApiAccountStats::make()->handle($clientAccount->id, \Carbon\Carbon::now());

    # assert
    $this->assertCount(2, $response['credits']);
    $this->assertCount(1, $response['debits']);

});


test("accounts stats should be empty if client hasn't made any deposit or spending", function () {
    # assert

    # action

    # assert
});

