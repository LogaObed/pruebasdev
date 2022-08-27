<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //para titulo una cadena falsa de 5 palabras
            'titulo'=>$this->faker->sentence(2),
            //para descripcion una cadena falsa de 15 palabras
            'descripcion'=>$this->faker->sentence(3),
            //para imagen un nombr eunico con .jpg
            'imagen'=>$this->faker->randomElement(['fa4865a3-2a5a-45f1-8b84-1a5529a496f2.png','307e247a-6912-4d65-8ce0-1ff0e18d3044.png','eea14b49-055a-44b0-b765-fc5266b45926.png']),
            //para el id se toma un numero aleatorio de un areglo
            'user_id'=>$this->faker->randomElement([4,5]),
        ];
    }
}
