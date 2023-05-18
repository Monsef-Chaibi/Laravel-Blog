<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'blog_name' => "blog name",
            'blog_email'=> fake()->email(),
            'blog_description'=> fake()->text(),
            'blog_logo'=> "blog logo",
            'blog_favicon'=> "blog ico"
        ];
    }
}
