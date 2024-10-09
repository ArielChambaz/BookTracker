<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AuthorFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */ 
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,  
            'last_name' => $this->faker->lastName,
            'birth_year' => $this->faker->dateTimeBetween('-400 years', '-5 years')->format('Y'),
            'email' => $this->faker->unique()->safeEmail(),
            //'email_verified_at' => now(),
            //'password' => static::$password ??= Hash::make('password'),
            //'remember_token' => Str::random(10),
            'description' => fake()->text(),
        ];
    }
}
