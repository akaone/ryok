<?php


namespace App\Actions\Account;


use App\Models\Operation;
use App\Responses\ApiErrorCode;
use App\Responses\ApiResponse;
use App\Rules\ApiAccountStatsRule;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ApiAccountStats
{
    use AsAction;
    const credit = "credit";
    const debit = "debit";

    public function rules(): array
    {
        return [
            'year_month' => ["string", "required", new ApiAccountStatsRule]
        ];
    }

    public function handle(string $accountId, $month)
    {
        $date = Carbon::parse($month);

        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();

        $operations = Operation::where('state', '=', Operation::$PAID)
            ->whereIn('type', [
                Operation::FROM_MOBILE_MONEY_TO_CLIENT_ACCOUNT,
                Operation::FROM_CLIENT_ACCOUNT_TO_MOBILE_MONEY,
                Operation::FROM_CLIENT_ACCOUNT_TO_APP_ACCOUNT,
            ])
            ->where('created_at', '>=', $startOfMonth)
            ->where('created_at', '<=', $endOfMonth)
            ->where(function ($query) use ($accountId){
                $query->where('account_id', '=', $accountId)
                    ->orWhere('from', '=', $accountId);
            })
            ->get();

        $groupedByCreditAndDebit = $operations->groupBy(function ($item, $key) use ($accountId) {
            return $item->account_id == $accountId ? ApiAccountStats::credit : ApiAccountStats::debit;
        });


        $creditTotal =  $this->getOperationTotal($groupedByCreditAndDebit->get(ApiAccountStats::credit));
        $debitTotal = $this->getOperationTotal($groupedByCreditAndDebit->get(ApiAccountStats::debit));

        $creditOperations = $this->calculateOperations($groupedByCreditAndDebit->get(ApiAccountStats::credit));
        $debitOperations = $this->calculateOperations($groupedByCreditAndDebit->get(ApiAccountStats::debit));

        $response = collect();

        $response->put('calendar_days', $this->getCalendarDays($date));

        $response->put('month_credit', $creditTotal);
        $response->put('credits', $creditOperations);

        $response->put('month_debit', $debitTotal);
        $response->put('debits', $debitOperations);

        return $response;
    }

    public function asController(ActionRequest $request): Collection
    {
        $accountId = auth()->user()->primaryAccount->id;
        return $this->handle($accountId, $request->input("year_month"));
    }

    public function jsonResponse(Collection $accountStats): JsonResponse
    {
        return ApiResponse::create(
            true,
            ApiErrorCode::NONE,
            $accountStats->toArray()
        );
    }

    private function calculateOperations($collection): ?Collection
    {
        $result = collect([]);
        if($collection) {
            $formattedByWeek = $collection->groupBy(function ($row) {
                $date = Carbon::parse($row->created_at);
                $weekStart = $date->copy()->startOfWeek()->format("d");
                $weekEnd = $date->copy()->endOfWeek()->format("d");
                return "{$weekStart}-{$weekEnd}";
            });


            foreach ($formattedByWeek as $key => $value) {
                $result->put($key, $value->sum("amount_requested"));
            }
        }

        return $result;

    }

    private function getCalendarDays(Carbon $startDate): Collection
    {
        $month = $startDate->copy()->month;
        $year = $startDate->copy()->year;
        $date = Carbon::createFromDate($year,$month);
        // $numberOfWeeks = floor($date->daysInMonth / Carbon::DAYS_PER_WEEK);

        $calendar = collect();
        for ($i=1; $i <= $date->daysInMonth ; $i++) {
            $tempDate = Carbon::createFromDate($year,$month,$i);
            $calendar->push($tempDate->copy()->startOfWeek()->format("d") . "-" . $tempDate->copy()->endOfweek()->format("d"));
            $i+=7;
        }

        return $calendar;
    }

    private function getOperationTotal($operations): int
    {
        return  $operations && $operations->count() > 0 ? $operations->sum("amount_requested") : 0;
    }
}
