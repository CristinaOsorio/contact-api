<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Contact;
use \App\Models\PhoneNumber;
use \App\Models\Email;
use \App\Models\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'notes' => $this->faker->text(100),
            'birthday' => $this->faker->date(),
            'company' => $this->faker->company(),
            'website' => $this->faker->url(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Contact $contact) {

            $contact->phoneNumbers()->createMany(
                PhoneNumber::factory()->count(2)->make()->toArray()
            );
            $contact->emails()->createMany(
                Email::factory()->count(2)->make()->toArray()
            );
            $contact->addresses()->createMany(
                Address::factory()->count(2)->make()->toArray()
            );
        });
    }
}
