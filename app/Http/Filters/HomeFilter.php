<?php


namespace App\Http\Filters;


use App\Product;
use Illuminate\Http\Request;

class HomeFilter
{
    public function filter(Request $request){
        $products = Product::query()->orderBy('id', 'desc');

        if ($request->has('category')) {
            $products->where('category_id', '=', $request->get('category'));
        }

        return $products->paginate(6);
    }
}