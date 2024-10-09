<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Array of relevant category names
        $categoryNames = ['Sport', 'Health', 'Technology', 'Education', 'Travel','Science','Economy','Politics'];
        $categoryColors = ['green','red','yellow','purple','orange','pink','blue','gray'];
        // Select a random category name from the array
        $name = $this->faker->unique()->randomElement($categoryNames);
        $color = $this->faker->unique()->randomElement($categoryColors); 
        return [
            'name' => $name,
            'color' => $color,
            'description' => $this->faker->paragraph,  // Generate random description 
            'slug' => Str::slug($name),  // Convert name to lowercase and replace spaces with hyphens
        ];
    }
}
