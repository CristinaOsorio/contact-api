<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    protected $model = \App\Models\Email::class;

    public function definition()
    {
        return [
            'address' => $this->faker->safeEmail(),
            'contact_id' => null,
        ];
    }
}
