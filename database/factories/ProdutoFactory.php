<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->word(),
            'valor' => $this->faker->numberBetween(10, 1000),
            'ativo' => $this->faker->boolean(),
            'loja_id' => \App\Models\Loja::factory(),
        ];
    }
}
