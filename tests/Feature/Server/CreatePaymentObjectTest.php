<?php

use App\Models\Account;
use App\Models\App;
use App\Models\AppKey;
use App\Models\AppUser;
use App\Models\User;
use App\Responses\ApiErrorCode;
use Webpatser\Uuid\Uuid;


test("member cannot get payment object without secret key", function () {

    $response = $this->json('POST', route('api.payment-request.index'), [
        'amount' => 1000,
        'currency' => "XOF"
    ]);

    # dd($response->getData());
    $data = $response->getData();
    $this->assertEquals(ApiErrorCode::MERCHANT_API_AUTH_PROVIDE_SECRET_KEY, $data->error_code);

});

test("member cannot be auth with fake secret key", function () {

    $response = $this->json('POST', route('api.payment-request.index'), [
        'amount' => 1000,
        'currency' => "XOF"
    ], ['apikey' => 'sk-live-fake-some-secret']);

    # dd($response->getData());
    $data = $response->getData();
    $this->assertEquals(ApiErrorCode::MERCHANT_API_AUTH_INVALID, $data->error_code);

});

test("member can get an api payment object", function () {
    # arrange
    $member = factory(User::class)->create(['state' => 'ACTIVATED']);
    $app = factory(App::class)->create(['state' => App::$ACTIVATED]);
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

    $response = $this->json('POST', route('api.payment-request.index'), [
        'amount' => 1500,
        'currency' => "XOF"
    ], ['apikey' => $appKey->secret_key]);

    # dd($response->getData());
    $data = $response->getData();
    $this->assertTrue($data->success);
    $this->assertTrue($data->data->live);
    $this->assertDatabaseHas('operations', ['account_id' => $account->id]);


});

test("member can not get payment object with a deactivated secret key", function () {
    # arrange
    $member = factory(User::class)->create(['state' => 'ACTIVATED']);
    $app = factory(App::class)->create(['state' => App::$ACTIVATED]);
    $appUser = AppUser::factory()->create(['app_id' => $app->id, 'user_id' => $member->id]);
    $appUser->assignRole('admin');
    $appKey = AppKey::factory()->create([
        'app_id' => $app->id,
        'secret_key' => 'sk-live-random-secret-shit',
        'public_key' => 'pk-live-random-public-shit',
        'test_secret_key' => 'sk-test-random-secret-shit',
        'test_public_key' => 'pk-test-random-public-shit',
        'state' => AppKey::$STATE_DEACTIVATED,
    ]);
    $account = Account::factory()->create(['app_id' => $app->id, 'id' => Uuid::generate()->string, 'type' => 'APP' ]);

    $response = $this->json('POST', route('api.payment-request.index'), [
        'amount' => 1500,
        'currency' => "XOF"
    ], ['apikey' => $appKey->secret_key]);

    # dd($response->getData());
    $data = $response->getData();
    $this->assertFalse($data->success);
    $this->assertEquals(ApiErrorCode::MERCHANT_API_AUTH_INVALID, $data->error_code);

});

test("member can not get payment object for a deactivated app", function () {
    # arrange
    $member = factory(User::class)->create(['state' => 'ACTIVATED']);
    $app = factory(App::class)->create(['state' => App::$DEACTIVATED]);
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

    $response = $this->json('POST', route('api.payment-request.index'), [
        'amount' => 1500,
        'currency' => "XOF"
    ], ['apikey' => $appKey->secret_key]);

    # dd($response->getData());
    $data = $response->getData();
    $this->assertFalse($data->success);
    $this->assertEquals(ApiErrorCode::MERCHANT_APP_IS_NOT_ACTIVATED, $data->error_code);

});

test("member can get test payment object for a deactivated app", function () {
    # arrange
    $member = factory(User::class)->create(['state' => 'ACTIVATED']);
    $app = factory(App::class)->create(['state' => App::$DEACTIVATED]);
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

    $response = $this->json('POST', route('api.payment-request.index'), [
        'amount' => 1500,
        'currency' => "XOF"
    ], ['apikey' => $appKey->test_secret_key]);

    # dd($response->getData());
    $data = $response->getData();
    $this->assertTrue($data->success);
    $this->assertFalse($data->data->live);
    $this->assertDatabaseHas('operations', ['account_id' => $account->id]);

});
