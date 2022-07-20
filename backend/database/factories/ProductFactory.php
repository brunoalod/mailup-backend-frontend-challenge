<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($this->faker));
        $this->faker->addProvider(new \Bezhanov\Faker\Provider\Placeholder($this->faker));

        return [
            'name' => $this->faker->productName,
            'description' => $this->faker->realText,
            'brand' => ucfirst($this->faker->word(1)),
            'category' => $this->faker->department,
            'image' => $this->faker->placeholder(),
            'price' => $price = random_int(100, 10000),
            'price_sale' => $price * 1.5,
            'stock' => random_int(100, 1000),
        ];
    }
}
