<?php

use App\Models\Client;

test("client can signup", function () {
    # action
    $response = $this->json('POST', route('api.client.auth.store'), [
        'country_code' => 228,
        'phone_number' => 91973610
    ]);

    # assert
    # dd($response->getData());
    $data = $response->getData();
    $this->assertTrue($data->success);
    $this->assertDatabaseHas('clients', ['state' => Client::$STATE_SMS, 'phone_number' => 91973610 ]);

});


test("client with sms state can still signup", function () {
    # assert
    Client::factory()->create([
        'country_code' => 228,
        'phone_number' => 91973610,
        'state' => Client::$STATE_SMS,
        'sms_code' => "568024"
    ]);

    # action
    $response = $this->json('POST', route('api.client.auth.store'), [
        'country_code' => 228,
        'phone_number' => 91973610
    ]);

    # assert
    # dd($response->getData());
    $data = $response->getData();
    $this->assertTrue($data->success);
    $this->assertDatabaseHas('clients', ['state' => Client::$STATE_SMS, 'phone_number' => 91973610 ]);
    $this->assertDatabaseMissing('clients', ['state' => Client::$STATE_SMS, 'code_sms' => "568024" ]);

});


test("client with sms state can complete signup", function () {
    # assert
    /** Client $client */
    $client = Client::factory()->create([
        'country_code' => 228,
        'phone_number' => 91973610,
        'state' => Client::$STATE_SMS,
        'sms_code' => "568024"
    ]);

    # action
    $response = $this->json('POST', route('api.client.auth.pass'), [
        'country_code' => $client->country_code,
        'phone_number' => $client->phone_number,
        'password' => "secret",
        'confirm_password' => "secret",
        'token_fcm' => "FCM_TOKEN",
        'sms_code' => $client->sms_code,
    ]);

    # assert
    # dd($response->getData());
    $data = $response->getData();
    $this->assertTrue($data->success);
    $response->assertJsonStructure(["success", "error_code", "errors", "data" => ["token"]]);
    $this->assertDatabaseHas('clients', ['state' => Client::$STATE_ACTIVATED, 'phone_number' => $client->phone_number ]);
    $this->assertDatabaseMissing('clients', ['state' => Client::$STATE_ACTIVATED, 'code_sms' => $client->sms_code ]);

});

# client with fake number cannot signup

# existing phone_number cannot sign up twice

# deactivate phone_number cannot sign up
