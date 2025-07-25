<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => $this->faker->numerify('#######'),
            'ean' => $this->faker->numerify('#############'),
            'un' => $this->faker->numberBetween(1, 999),
            'categoria' => $this->faker->numberBetween(1000,9999),
            'descrição' => $this->faker->text(),
            'contagem' => $this->faker->numberBetween(1, 99),
            'stock' => $this->faker->numberBetween(1, 999),
            'diferença_stock' => $this->faker->randomNumber()
        ];
    }
}
