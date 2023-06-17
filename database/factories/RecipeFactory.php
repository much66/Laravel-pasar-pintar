<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement([1, 2, 3, 4]);
        if ($type == 1){
            $image = "recipes-images/sayur.jpg";
        } else if ($type == 2){
            $image = "recipes-images/gorengan.jpg";
        } else if ($type == 3){
            $image = "recipes-images/tumis.jpg";
        }else if ($type == 4){
            $image = "recipes-images/jus.jpeg";
        }
        return [
            'user_id' => 1,
            'type_id' => $type,
            'name' => fake()->sentence(3),
            'slug' => fake()->slug(),
            'image' => $image,
            'igredient' => collect($this->faker->sentences(mt_rand(2,5)))->map(fn($p) =>"<li>$p</li>")->implode(''),
            'description' => collect($this->faker->paragraphs(mt_rand(5,10)))->map(fn($p) =>"<li>$p</li>")->implode(''),
            'cooking_time'=> fake()->numberBetween(5, 60),
            'portion'=> fake()->randomDigitNotNull(),
        ];
    }
}
