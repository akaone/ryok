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
     * @param $app_id
     * @param $amount
     * @param $currency
     * @param $live
     * @return \stdClass
     */
    public function createPayment($app_id, $amount, $currency, $live)
    {

        $infos = new \stdClass();

        try {
            $operationId = Uuid::generate()->string;
            $qrImagePath = "/albums/qr-code/{$operationId}.png";

            $deepLink = "wwwwwwwww";

            Operation::create([
                'id' => $operationId,
                'qr_code' => $qrImagePath,
                'deep_link_url' => $deepLink,
                'app_id' => $app_id,
                'amount_requested' => $amount,
                'curerncy_requested' => $currency,
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

        } catch (\Exception $exception) {
            $infos->created = false;
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
            ->join('apps as ap', 'ap.id', '=', 'op.app_id')
            ->select(['op.amount_requested', 'op.curerncy_requested', 'deep_link_url', 'ap.name', 'ap.icon'])
            ->first();
    }
}
