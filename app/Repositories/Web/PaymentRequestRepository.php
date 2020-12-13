<?php

namespace App\Repositories\Web;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use Carbon\Carbon;

use Spatie\Browsershot\Browsershot;

class PaymentRequestRepository
{
    /**
     * @param $accountId
     * @param $amount
     * @param $currency
     * @param $live
     * @return \stdClass
     */
    public function createPayment($accountId, $amount, $currency, $live)
    {

        $infos = new \stdClass();

        try {

            DB::beginTransaction();

            $operationId = Uuid::generate()->string;
            $qrImagePath = "/albums/qr-code/{$operationId}.png";

            $deepLink = url(route('operation-qr-code', ['id' => $operationId, 'browser' => "yes"]));

            Operation::create([
                'id' => $operationId,
                'qr_code' => $qrImagePath,
                'deep_link_url' => $deepLink,
                'account_id' => $accountId,
                'amount_requested' => $amount,
                'currency_requested' => $currency,
                'live' => $live,
            ]);


            Browsershot::url(route('operation-qr-code', ['id' => $operationId]))
                ->setNodeModulePath(base_path() ."/node_modules/")
                ->select('#container')
                ->save(public_path() . $qrImagePath);

            $infos->created = true;
            $infos->qrCode = asset($qrImagePath);
            $infos->deepLinkUrl = $deepLink;
            $infos->live = $live;

            DB::commit();

        } catch (\Exception $exception) {
            $infos->created = false;
            DB::rollBack();
        }

        return $infos;
    }


    /**
     * @param $operationId
     * @return Model|Builder|object|null
     */
    public function fetchOperationInfoForQrcode($operationId)
    {
        return DB::table('operations as op')
            ->where('op.id', $operationId)
            ->join('accounts as ac', 'ac.id', '=', 'op.account_id')
            ->join('apps as app', 'app.id', '=', 'ac.app_id')
            ->select(['op.amount_requested', 'op.currency_requested', 'deep_link_url', 'app.name', 'app.icon'])
            ->first();
    }
}
