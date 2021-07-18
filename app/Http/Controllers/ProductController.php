<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    
    public function get() {

        $product_type = request()->product_type;

        if(empty($product_type) || !in_array($product_type, ['delivery', 'normal'])){
            return response(['message' => 'You must select type of product delivery or normal'], 400);
        }

        $products = Product::where('product_type', $product_type)->get();

        $category_ids = request()->category_ids;
        $category_ids = json_decode($category_ids, true);

        //Si se ha enviado category_ids
        if(!empty($category_ids)){
            $products = $products->filter(function ($product) use ($category_ids){
                return in_array($product->category_id, $category_ids);
            });
        }

        $subcategory_ids = request()->subcategory_ids;
        $subcategory_ids = json_decode($subcategory_ids, true);

        //Si se ha enviado subcategory_ids
        if(!empty($subcategory_ids)){
            $products = $products->filter(function ($product) use ($subcategory_ids){
                return in_array($product->subcategory_id, $subcategory_ids);
            });
        }

        return $products;
    }

    public function search (Request $request){

        $product_type = $request->product_type;

        if(empty($product_type) || !in_array($product_type, ['delivery', 'normal'])){
            return response(['message' => 'You must select type of product delivery or normal'], 400);
        }

        $search = $request->search;

        if(empty($search)){
            return response(['message' => 'search field is empty'], 400);
        }

        $products = Product::where('product_type', $product_type)->get();

        $search_terms = explode(' ', $request->search);

        $products = $products->filter(function ($product) use ($search_terms){
            foreach($search_terms as $search_term){
                return preg_match('%'.strtolower($search_term).'%', strtolower($product->description)) 
                    || preg_match('%'.strtolower($search_term).'%', strtolower($product->name));
            };
        });

        return $products;
    }
}
