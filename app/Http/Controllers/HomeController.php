<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index(Request $request)
    {
        $products = Product::query()->orderBy('id', 'desc');

        if ($request->has('category')) {
            $products->where('category_id', '=', $request->get('category'));
        }


        $categories = Category::all();
        return view('home', ['products' => $products->paginate(6), 'categories' => $categories]);
    }
}
