<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(2, 5)),
            'author_id' => Author::factory(),
            'category_id' => Category::inRandomOrder()->first()->id, // Assign random category 
            //'slug' => Str::slug(fake()->sentence()),
            //'body' => implode("<br><br>", fake()->paragraphs(rand(3, 6))),
            'body' => implode("<br><br>", array_map(function() {
                return fake()->text(500); // Generates a longer text (300 characters).
                }, range(1, rand(5, 9))) // Generates between 3 to 5 paragraphs.
            ),

            'published_year' =>$this->faker->dateTimeBetween('-400 years', '-5 years')->format('Y'),
        ];
    }
}
