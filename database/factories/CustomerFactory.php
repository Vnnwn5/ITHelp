<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'id_number' => $this->faker->unique()->randomNumber(8),
            'email' => $this->faker->unique()-> email,
            'address' =>$this->faker->address,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
