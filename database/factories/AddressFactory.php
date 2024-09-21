<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{

    protected $model = \App\Models\Address::class;

    public function definition()
    {
        return [
            'location' => $this->faker->address(),
            'contact_id' => null,
        ];
    }
}
