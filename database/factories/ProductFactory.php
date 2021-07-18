<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Subcategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category_id = rand(1, Category::all()->count());

        $subcategories = Subcategory::where('category_id', $category_id)->get();

        $subcategory_id = rand($subcategories->min('id'), $subcategories->max('id'));

        $product_type = ['normal', 'delivery'];

        return [
            'name'           => $this->faker->word,
            'category_id'    => $category_id,
            'subcategory_id' => $subcategory_id,
            'product_type'   => $product_type[rand(0,1)],
            'description'    => $this->faker->sentence,
            'price'          => $this->faker->randomFloat(3, 2, 100)
        ];
    }
}
