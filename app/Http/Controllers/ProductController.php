<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryAttributes;
use App\Http\Requests\ProductRequest;
use App\Policies\ProductPolicy;
use App\Product;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    function __construct()
    {
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(5);
        return view('products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        $categories = Category::getCategoriesByUser($user)->toJson();

        return view('products.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        $this->authorize('create', $request->get('category'));

        $product = Product::create([
            'name' => $request->get('name'),
            'category_id' => $request->get('category'),
            'image' => Product::getNameUploadImage($request),
        ]);

        $product->setProductAttributes($request);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $user = Auth::user();
        $this->authorize(ProductPolicy::MANAGERS, $product->category->id);
        $categories = Category::getCategoriesByUser($user)->toJson();
        $attributes = CategoryAttributes::getAttributesByProduct($product);
        return view('products.edit', compact('product', 'categories', 'attributes'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize(ProductPolicy::MANAGERS, $product->category->id);
        $product = Product::create([
            'name' => $request->get('name'),
            'category_id' => $request->get('category'),
            'image' => Product::getNameUploadImage($request),
        ]);

        $product->setProductAttributes($request);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $this->authorize(ProductPolicy::MANAGERS, $product->category->id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
