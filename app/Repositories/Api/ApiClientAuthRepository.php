<?php


namespace App\Repositories\Api;


use App\Models\App;
use App\Models\AppKey;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ApiClientAuthRepository
{
    /**
     * @param $countryCode
     * @param $phoneNumber
     * @param $smsCode
     * @return Client|Model|null
     */
    public function saveClientPhoneNumber($countryCode, $phoneNumber, $smsCode)
    {
        try {
            $client = Client::firstOrNew([
                'country_code' => $countryCode,
                'phone_number' => $phoneNumber
            ], ['state' => Client::$STATE_SMS]);

            if(Client::$STATE_SMS != $client->state) {
                return null;
            }

            $client->sms_code = $smsCode;
            $client->save();

            return $client;
        } catch (QueryException $exception) {
            return null;
        }
    }

    public static function quickRandom($length = 6)
    {
        $pool = '0123456789';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

}
