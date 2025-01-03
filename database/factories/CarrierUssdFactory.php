<?php

namespace Database\Factories;

use App\Models\CarrierUssd;
use Illuminate\Database\Eloquent\Factories\Factory;
use Webpatser\Uuid\Uuid;

class CarrierUssdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarrierUssd::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Uuid::generate()->string,
        ];
    }
}
