<?php


namespace App\Actions\Operations;


use App\Models\Operation;
use App\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 *
 * @OA\Get(
 *     path="/client/operations",
 *     tags={"operations"},
 *     summary=" []",
 *     @OA\Parameter(name="page", in="query", description="The page to fetch", required=true),
 *     @OA\Response(
 *         response=200,
 *         description="SUCCESS",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                     @OA\Property(
 *                         property="operations",
 *                         type="array",
 *                         @OA\Items(
 *                             @OA\Property(property="id", type="string", description="Operation's id"),
 *                             @OA\Property(property="amount", type="string", description="Operation's amount"),
 *                             @OA\Property(property="currency", type="enum", description="Operation's currency", enum={"XOF"}),
 *                             @OA\Property(property="phone_number", type="string", description="Used phone number"),
 *                             @OA\Property(property="created_at", type="string", description="Operation creation date"),
 *                             @OA\Property(property="live", type="enum", description="If oeration is live mode", enum={"0", "1"}),
 *                             @OA\Property(property="app_name", type="string", description="Name of the app the client paid to"),
 *                             @OA\Property(property="app_icon", type="string", description="Icon of the app the client paid to"),
 *                             @OA\Property(property="ussd_reference", type="string", description="Ussd transaction reference"),
 *                         )
 *                     ),
 *                 ),
 *             ),
 *         )
 *     ),
 *
 * )
 * @return JsonResponse
 */
class ListClientOperations
{
    use AsAction;

    public function rules(): array
    {
        return [];
    }

    public function handle(string $accountId, int $page): Collection
    {
        $operations = $this->clientOperations($accountId, $page);

        $operations->each(function($item, $key) use ($operations) {
            $operations[$key]->icon = asset($item->icon);
        });

        return $operations;
    }

    public function asController(ActionRequest $request): Collection
    {
        $accountId = auth()->user()->primaryAccount->id;
        $page = $request->input("page", 0);
        return $this->handle($accountId, $page);
    }

    public function jsonResponse(Collection $operations): JsonResponse
    {
        return ApiResponse::create(
            true,
            "",
            [
                'operations' => $operations,
            ]
        );
    }

    private function clientOperations(string $accountId, int $page): Collection
    {
        # todo: add pagination
        # todo: this currently only show direct payment to merchant update to fit all operations cases
        return Operation::from('operations as op')
            ->where('op.account_id', '=', $accountId)
            ->where('op.for_operation', '!=', null)
            ->join('operations as tmp', 'tmp.id', '=', 'op.for_operation')
            ->join('accounts as act', 'act.id', '=', 'tmp.account_id')
            ->join('apps', 'apps.id', '=', 'act.app_id')
            ->select([
                'op.id' ,'op.ussd_reference', 'op.amount_requested as amount','op.from as phone_number',
                'op.currency_requested as currency', 'op.created_at', 'op.live',
                'apps.name as app_name', 'apps.icon as app_icon'
            ])
            ->get();
    }
}
