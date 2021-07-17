<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class CategoryController extends Controller{
   
    public function get()
    {
        $categories = Category::all();

        $categories = $categories->map(function ($category){
            return $category->only(['id', 'name']);
        });  

        $categories_subcategories = $categories->map(function ($category){

            $subcategories = Subcategory::where('category_id', '=', $category['id'])->get();

            $subcategories = $subcategories->map(function ($subcategory){
                return $subcategory->only(['id', 'name']);
            });

            return [
                'category' => $category,
                'subcategories' => $subcategories
            ];
        });

        return response($categories_subcategories);

    }
}
