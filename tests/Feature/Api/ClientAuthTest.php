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

# client with fake number cannot signup
