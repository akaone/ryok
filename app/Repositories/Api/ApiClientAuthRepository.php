<?php /** @noinspection LaravelFunctionsInspection */


namespace App\Repositories\Api;

use App\Models\Client;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;


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


    public function saveClientPassword($countryCode, $phoneNumber, $smsCode, $password, $tokenFcm)
    {
        $searchData =  ['country_code' => $countryCode, 'phone_number' => $phoneNumber, 'sms_code' => $smsCode];
        $client = Client::where($searchData)
            ->update(['password' => $password, 'fcm' => $tokenFcm ]);

        if(1 == $client) {
            # todo: generate token | update sms code
            $client =  Client::where($searchData)->first();
            $client->sms_code = self::quickRandom();
            $client->state = Client::$STATE_ACTIVATED;

            $now = Carbon::now();
            $token = JWT::encode([
                'iat' => $now,
                'exp' => $now->addHours(1),
                'sub' => $client->id,
                'phone_number' => "{$client->country_code} {$client->phone_number}",
            ], env("JWT_SECRET"));

            $client->jwt = $token;
            $client->save();


            return $token;
        }
        return null;

    }


    public static function quickRandom($length = 6)
    {
        $pool = '0123456789';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

}
