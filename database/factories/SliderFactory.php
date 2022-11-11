<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sliderName = $this->faker->text(rand(8,40));
        return [
            'sliderName' =>  $sliderName,
            'slug'       =>  str_slug($sliderName),
            'published_at'     =>  Carbon::today()->subDays(rand(0, 365)),
            'sliderText'       => $this->faker->text(rand(30,230)),
            'viewCount'      => $this->faker->randomNumber(2,false),
            'sliderImg'  => 'https://source.unsplash.com/random',

        ];
    }
}
