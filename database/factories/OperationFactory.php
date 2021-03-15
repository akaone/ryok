<?php

namespace Database\Factories;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Operation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function fromMobileMoneyToClientAccount()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => Operation::FROM_MOBILE_MONEY_TO_CLIENT_ACCOUNT,
                'state' => Operation::$PAID,

            ];
        });
    }
    public function fromClientAccountToAppAccount()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => Operation::FROM_CLIENT_ACCOUNT_TO_APP_ACCOUNT,
                'state' => Operation::$PAID,

            ];
        });
    }
}
