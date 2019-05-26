<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Filters\HomeFilter;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index(Request $request)
    {
        $products = HomeFilter::filter($request);

        $categories = Category::all();
        return view('home', ['products' => $products, 'categories' => $categories]);
    }
}
