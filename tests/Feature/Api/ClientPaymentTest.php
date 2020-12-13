<?php

use App\Models\Account;
use App\Models\App;
use App\Models\AppCarrier;
use App\Models\AppKey;
use App\Models\AppUser;
use App\Models\Carrier;
use App\Models\CarrierUssd;
use App\Models\Client;
use App\Models\Operation;
use App\Models\User;
use App\Repositories\Api\ApiClientAuthRepository;
use Webpatser\Uuid\Uuid;

$paymentOrderId = null;
$carrier = null;

beforeEach(function () use (&$paymentOrderId, &$carrier) {
    $merchant = factory(User::class)->create(['state' => 'ACTIVATED']);
    $app = factory(App::class)->create();
    $appUser = AppUser::factory()->create(['app_id' => $app->id, 'user_id' => $merchant->id]);
    $appUser->assignRole('admin');
    $appKey = AppKey::factory()->create([
        'app_id' => $app->id,
        'secret_key' => 'sk-live-random-secret-shit',
        'public_key' => 'pk-live-random-public-shit',
        'test_secret_key' => 'sk-test-random-secret-shit',
        'test_public_key' => 'pk-test-random-public-shit',
        'state' => AppKey::$STATE_ACTIVATED,
    ]);
    $account = Account::factory()->create(['app_id' => $app->id, 'id' => Uuid::generate()->string, 'type' => 'APP' ]);

    /** @var Carrier $carrier */
    $carrier = Carrier::factory()->create([
        'country' => 'TG',
        'name' => 'Togocel',
        'ibm' => '605-01',
        'is_api' => true,
        'phone_regex' => "^(90|91|92|93|70)",
        'state' => Carrier::$ACTIVATED
    ]);
    AppCarrier::factory()->create(['app_id' => $app->id, 'carrier_id' => $carrier->id, 'activated' => true]);
    CarrierUssd::factory()->create([
        'carrier_id' => $carrier->id,
        'client_ussd_format' => "*145*1*1*[AMOUNT]*[PHONE]*1*[PIN]#"
    ]);

    $response = $this->json('POST', route('api.payment-request'), [
        'amount' => 1500,
        'currency' => "XOF"
    ], ['api_key' => $appKey->secret_key]);

    dd($response->getData());
    $data = $response->getData();
    $this->assertTrue($data->success);
    $this->assertDatabaseHas('operations', ['account_id' => $account->id]);
    $paymentOrderId = $data->data->url;
    $paymentOrderId = explode("?", explode("/", $paymentOrderId)[5])[0];
});


test("client can pay a merchant with scan using mobile money", function () use (&$paymentOrderId, &$carrier) {
    # merchant generate operation code (in beforeEach)

    # user scan the qr code, pick a carrier and dial the ussd to pay
    /** @var Client $client */
    $client = Client::factory()->create([
        'country_code' => 228,
        'phone_number' => 91973610,
        'state' => Client::$STATE_ACTIVATED,
    ]);
    /** @var Account $clientPrimaryAccount */
    $clientPrimaryAccount = Account::factory()->create(['client_id' => $client->id, 'type' => 'CLIENT']);

    $clientAuthRep = new ApiClientAuthRepository();
    $token = $clientAuthRep->loginClient($client->country_code, $client->phone_number, "secret");
    $clientScanResponse = $this->json('POST', route('api.client.qr-code.index'), [
        'operation_id' => $paymentOrderId,
    ], ['authorization' => "Bearer: {$token}"]);

    # dd($clientScanResponse->getData());
    $clientScanData = $clientScanResponse->getData();
    $this->assertTrue($clientScanData->success);
    $this->assertDatabaseHas('operations', ['id' => $paymentOrderId, 'state' => Operation::$CREATED]);
    $this->assertDatabaseHas('operations', ['id' =>  $clientScanData->data->mobile_id, 'state' => Operation::$CREATED]);

    # user send the ussd response and the sms response to the server
    $clientUssdResponse = $this->json('PATCH', route('api.client.qr-code.update'), [
        'client_id' =>  $client->id,
        'mobile_id' => $clientScanData->data->mobile_id,
        'carrier_id' =>  $carrier->id,
        'ussd_content' => "REF #207254621. Vous avez envoye 46000F a Femi de SOUZA...",
        'sms_content' => "REF #207254621. Vous avez envoye 46000F a Femi de SOUZA...",
        'phone_number' => "{$client->country_code}{$client->phone_number}",
    ], ['authorization' => "Bearer: {$token}"]);
    # dd($clientUssdResponse->getData());

    $this->assertDatabaseHas('operations', ['id' => $paymentOrderId, 'state' => Operation::$PENDING]);
    $this->assertDatabaseHas('operations', [
        'id' =>  $clientScanData->data->mobile_id,
        'state' => Operation::$PENDING,
        'account_id' => $clientPrimaryAccount->id
    ]);


    # watcher app send the carrier sms to the server

    # cron task checks if the operation is successful using the messages_table and the operations_table

    # update client account balance

    # create transfer from client account to app account
    # update client account balance
    # update app account balance

    # if successful call vendor webhook
    # notify user

    # action

    # assert

});
