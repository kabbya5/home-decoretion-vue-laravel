<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
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
            'subCatName' => $catName,
            'slug'  => str_slug($catName),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
