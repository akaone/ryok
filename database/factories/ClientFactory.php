<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'state' => $this->faker->randomElement([
                Client::$STATE_SMS, Client::$STATE_ACTIVATED, Client::$STATE_DEACTIVATED]),
            'sms_code' => env("DEV_SMS_CODE"),
            'password' => Hash::make("secret")
        ];
    }
}
