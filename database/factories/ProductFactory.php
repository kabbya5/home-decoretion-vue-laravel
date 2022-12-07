<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

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
    public function definition()
    {   $name =  rtrim($this->faker->text(rand(15,30)),'.');
        return [
            'category_id' => rand(1,10),
            'subcategory_id' =>rand(1,10),
            'brand_id' => rand(1,10),
            'slider_id' => rand(1,10),
            'seller_id' => rand(1,10),
            'product_title' => $name,
            'slug' => str_slug($name),
            'price' => rand(20,500),
            'discount_price' => rand(500,50000),
            'short_text'  => $this->faker->paragraphs(rand(3,6),true),
            'description' => $this->faker->paragraphs(rand(8,15),true),
            'quantity' => rand(20,80),
            'weight' => rand(30,60),
            'free_shipping' => rand(0,1),
            'top_rated' => rand(0,1),
            'is_weekly_sale' => rand(0,1),
            'published_at' => Carbon::today()->subDays(rand(0, 365)),
            'view_count' => $this->faker->randomNumber(2,false),
        ];
    }
}
