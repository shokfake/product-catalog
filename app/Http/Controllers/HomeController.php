<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index(Request $request)
    {
        $products = Product::query()->orderBy('id','desc');
        $products = \GuzzleHttp\json_encode($products->get());
        $categories = \GuzzleHttp\json_encode(Category::all());
        return view('home', ['products' => $products, 'categories'=> $categories]);
    }
}
