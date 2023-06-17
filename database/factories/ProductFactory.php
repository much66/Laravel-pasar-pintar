<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8]);
        if ($category == 1){
            $image = "product-images/sayuran.jpg";
        } else if ($category == 2){
            $image = "product-images/buah.jpg";
        } else if ($category == 3){
            $image = "product-images/daging.jpeg";
        }else if ($category == 4){
            $image = "product-images/seafood.jpg";
        }else if ($category == 5){
            $image = "product-images/bumbu-dapur.jpg";
        }else if ($category == 6){
            $image = "product-images/bahan-kue.jpg";
        }else if ($category == 7){
            $image = "product-images/minuman.jpg";
        }else if ($category == 8){
            $image = "product-images/lainnya.jpg";
        }
        return [
            'category_id' => $category,
            'user_id' => fake()->randomElement([2,3]),
            'name' => fake()->word(),
            'slug' => fake()->slug(),
            'image' => $image,
            'stock' => fake()->numberBetween(0,100),
            'sold' => fake()->numberBetween(0,10000),
            'desc' => fake()->paragraph(),
            'price' => fake()->numberBetween(2000, 25000),
            'rating' => fake()->randomFloat(1, 2, 5)
        ];
    }
}
