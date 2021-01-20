<?php /** @noinspection LaravelFunctionsInspection */


namespace App\Repositories\Api;

use App\Models\Account;
use App\Models\Client;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;


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


    /**
     * @param $countryCode
     * @param $phoneNumber
     * @param $smsCode
     * @param $password
     * @param $tokenFcm
     * @return string|null
     */
    public function saveClientPassword($countryCode, $phoneNumber, $smsCode, $password, $tokenFcm)
    {
        $searchData =  ['country_code' => $countryCode, 'phone_number' => $phoneNumber, 'sms_code' => $smsCode, 'state' => Client::$STATE_SMS];
        $client = Client::where($searchData)
            ->update(['password' => Hash::make($password), 'fcm' => $tokenFcm ]);

        if(1 == $client) {
            $client =  Client::where($searchData)->first();
            $client->sms_code = self::quickRandom();
            $client->state = Client::$STATE_ACTIVATED;

            $now = Carbon::now();
            $token = JWT::encode([
                'iat' => $now->timestamp,
                'exp' => $now->addHours(1)->timestamp,
                'sub' => $client->id,
                'phone_number' => "{$client->country_code} {$client->phone_number}",
            ], env("JWT_SECRET"));

            $client->jwt = $token;
            $client->save();

            Account::create([
                'id' => Uuid::generate()->string,
                'client_id' => $client->id,
                'type' => Account::$ACCOUNT_TYPE_CLIENT
            ]);

            return $token;
        }
        return null;

    }


    public function loginClient($countryCode, $phoneNumber, $password)
    {
        $client = Client::where([
            'country_code' => $countryCode, 'phone_number' => $phoneNumber
        ])->first();

        if(null == $client || false == Hash::check($password, $client->password)) return null;

        $now = Carbon::now();
        $token = JWT::encode([
            'iat' => $now->timestamp,
            'exp' => $now->addHours(1)->timestamp,
            'sub' => $client->id,
            'phone_number' => "{$client->country_code} {$client->phone_number}",
        ], env("JWT_SECRET"));

        $client->jwt = $token;
        $client->save();

        return $token;
    }


    public static function quickRandom($length = 6)
    {
        $pool = '0123456789';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

}
