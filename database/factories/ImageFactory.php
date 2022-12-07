<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $array = ['App\Models\Product','App\Models\Tag'];
        $img = [
            "https://placeimg.com/500/500/any?1",

            "https://placeimg.com/500/500/any?2",

            "https://placeimg.com/500/500/any?3",

            "https://placeimg.com/500/500/any?4",
            'https://source.unsplash.com/random',
        ];
        return [
            'product_img_name' => $this->faker->text(rand(8,30)),
            'product_img' => $img[rand(0,4)],
        ];
    }
}
