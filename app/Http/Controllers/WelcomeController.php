<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;


class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()->orderBy('id','desc');
        $queries = [];
        $queryCategories = explode(',',$request->get('categories'));
        if ( request()->has('categories') )
        {
            $products = $products->hasCategories($queryCategories);
            $queries[ 'categories' ] = request('categories');
        }

        $links = $products->paginate(12)->appends($queries)->links();
//        $products = Product::orderBy('id','desc')->paginate(12);
        $categories = Category::all();
        return view('welcome', ['products' => $products->get(), 'links' => $links, 'categories'=> $categories]);
    }
}