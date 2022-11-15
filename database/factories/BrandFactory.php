<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $BrandName = $this->faker->text(rand(8,30));
        return [
            'name' => $BrandName,
            'slug' => str_slug($BrandName),
            'brand_img' => 'https://source.unsplash.com/random',
        ];
    }
}
