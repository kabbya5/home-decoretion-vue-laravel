<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Childcategory>
 */
class ChildcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $catName = $this->faker->text(rand(8,30));
        return [
            'subcategory_id' => Subcategory::all()->random()->id,
            'childCatName'   => $catName,
            'slug'  => str_slug($catName), 
        ];
    }
}
