<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhoneNumber>
 */
class PhoneNumberFactory extends Factory
{
    protected $model = \App\Models\PhoneNumber::class;

    public function definition()
    {
        return [
            'number' => $this->faker->phoneNumber(),
            'contact_id' => null,
        ];
    }
}
