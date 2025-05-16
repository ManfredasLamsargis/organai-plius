<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BodyPartOffer>
 */
class BodyPartOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 1000, 10000),
            'received_date' => $this->faker->date(),
            'description' => $this->faker->sentence(),
            'state' => 'not_accepted',
            'type_id' => 1,
            'auction_id' => null,
            'order_id' => null,
            'provider_id' => 1,
        ];
    }
}
