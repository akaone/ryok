<?php


namespace App\Actions\Account;


use App\Models\Operation;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class ApiAccountStats
{
    use AsAction;

    public function handle(string $accountId, $month)
    {
        $startOfMonth = Carbon::parse($month)->startOfMonth();
        $endOfMonth = Carbon::parse($month)->endOfMonth();

        $operations = Operation::where('state', '=', Operation::$PAID)
            ->whereNotIn('type', [Operation::FROM_MOBILE_MONEY_TO_CLIENT_ACCOUNT])
            ->where('created_at', '>=', $startOfMonth)
            ->where('created_at', '<=', $endOfMonth)
            ->where(function ($query) use ($accountId){
                $query->where('account_id', '=', $accountId)
                    ->orWhere('from', '=', $accountId);
            })
            ->get();

        dd($operations);
    }
}
