<?php

use App\Models\Account;
use App\Models\App;
use App\Models\AppKey;
use App\Models\AppUser;
use App\Models\User;
use Webpatser\Uuid\Uuid;


test("member cannot get payment object without secret key", function () {

    $response = $this->json('POST', route('api.payment-request'), [
        'amount' => 1000,
        'currency' => "XOF"
    ]);

    # dd($response->getData());
    $data = $response->getData();
    $this->assertEquals(\App\Responses\ApiErrorCode::MERCHANT_API_AUTH_PROVIDE_SECRET_KEY, $data->error_code);

});


test("member cannot be auth with fake secret key", function () {

    $response = $this->json('POST', route('api.payment-request'), [
        'amount' => 1000,
        'currency' => "XOF"
    ], ['api_key' => 'sk-live-fake-some-secret']);

    # dd($response->getData());
    $data = $response->getData();
    $this->assertEquals(\App\Responses\ApiErrorCode::MERCHANT_API_AUTH_INVALID, $data->error_code);

});


test("member can get an api payment object", function () {
    # arrange
    $member = factory(User::class)->create(['state' => 'ACTIVATED']);
    $app = factory(App::class)->create();
    $appUser = AppUser::factory()->create(['app_id' => $app->id, 'user_id' => $member->id]);
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

    $response = $this->json('POST', route('api.payment-request'), [
        'amount' => 1500,
        'currency' => "XOF"
    ], ['api_key' => $appKey->secret_key]);

    # dd($response->getData());
    $data = $response->getData();
    $this->assertTrue($data->success);
    $this->assertDatabaseHas('operations', ['account_id' => $account->id]);


});


# member can not get payment object with a deactivated secret key


# member can not get payment object for a deactivated app
