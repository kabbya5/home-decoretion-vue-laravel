<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $categoryName = $this->faker->text(rand(15,30));
        return [
            'categoryName' => $categoryName,
            'slug'         => str_slug($categoryName),
            'categoryImg'  => 'https://source.unsplash.com/random',
            'categoryImgName' => 'CategoryImage',
            'viewCount'        => $this->faker->randomNumber(2,false),
        ];
    }
}
