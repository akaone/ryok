<?php


namespace App\Actions\Operations;


use App\Models\Operation;
use Lorisleiva\Actions\Concerns\AsAction;
use Webpatser\Uuid\Uuid;

class InitMobileMoneyToClientAccount
{
    use AsAction;

    public function handle(bool $live, int $amount, string $currency, string $clientAccountId, string $forOperationId = null): Operation
    {
        return Operation::create([
            'id' => Uuid::generate()->string,
            'amount_requested' => $amount,
            'currency_requested' => $currency,
            'for_operation' => $forOperationId ?? null,
            'account_id' => $clientAccountId,
            'state' => Operation::$SCAN,
            'live' => $live,
            'type' => Operation::FROM_MOBILE_MONEY_TO_CLIENT_ACCOUNT
        ]);
    }

}
