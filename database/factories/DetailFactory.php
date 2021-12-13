<?php

namespace Danielebarbaro\EntityDetail\Database\Factories;

use Danielebarbaro\EntityDetail\Models\Detail;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailFactory extends Factory
{
    protected $model = Detail::class;

    public function definition()
    {
        return [
            'is_company' => $this->faker->boolean,
            'status' => $this->faker->randomElement([1, 2, 3]),
            'code' => $this->faker->numberBetween(4512, 81231),
            'name' => $this->faker->name,
            'secondary_email' => $this->faker->companyEmail,
            'sdi' => $this->faker->numberBetween(1234567, 8133231),
            'pec' => $this->faker->email,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'mobile' => $this->faker->phoneNumber,
            'fiscal_code' => $this->faker->text(),
            'vat' => $this->faker->vat,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country' => $this->faker->countryCode,
            'notes' => $this->faker->text(100),
        ];
    }
}
