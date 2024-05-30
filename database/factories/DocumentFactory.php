<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence,
            'publie_le' => $this->faker->date,
            'publie_par' => $this->faker->name,
            'extension' => $this->faker->randomElement(['pdf', 'doc', 'xlxs', 'png', 'jpg']),
            'type_document' => $this->faker->word,
            'etat' => $this->faker->boolean,
            'description' => $this->faker->paragraph(1),
            'nombre_vue' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
