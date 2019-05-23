<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductAttributesValue;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Auth::user();
        $categories = Auth::user()->categories;
        if ($users->hasRole('Super Admin')) {
            $categories = Category::all();
        }

        return view('products.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save(public_path('uploads/') . $filename);
            $product->image = $filename;
        };
        $product->save();

        foreach ($request->get('attributes') as $id => $value) {
            $attribute = new ProductAttributesValue();
            $attribute->product_id = $product->id;
            $attribute->category_attribute_id = (int)$id;
            $attribute->value = $value;
            $attribute->save();

        }


        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $users = Auth::user();
        $categories = Auth::user()->categories->pluck('name', 'id');
        if ($users->hasRole('Super Admin')) {
            $categories = Category::all();
        }

        $attributes = \DB::table('product_attributes_values')
            ->join('category_attributes', 'product_attributes_values.category_attribute_id', '=', 'category_attributes.id')
            ->join('products', 'product_attributes_values.product_id', '=', 'products.id')
            ->where('product_attributes_values.product_id', $product->id)
            ->select('product_attributes_values.*', 'category_attributes.name', 'product_attributes_values.value')
            ->get('name', 'value');

        return view('products.edit', compact('product', 'categories', 'attributes'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        request()->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $product->name = $request->name;
        $product->category_id = $request->category;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save(public_path('uploads/') . $filename);
            $product->image = $filename;
        };

        foreach ($request->get('attributes') as $id => $value) {
            $attribute = ProductAttributesValue::find($id);
            $attribute->value = $value;
            $attribute->update();

        }

        $product->save();


        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();


        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function attributes($id) {
        $product = Product::find($id);
        $attributes = \DB::table('product_attributes_values')
            ->join('category_attributes', 'product_attributes_values.category_attribute_id', '=', 'category_attributes.id')
            ->join('products', 'product_attributes_values.product_id', '=', 'products.id')
            ->where('product_attributes_values.product_id', $product->id)
            ->select('product_attributes_values.*', 'category_attributes.name', 'product_attributes_values.value')
            ->get('name', 'value');
        return response()->json($attributes, 200);
    }
}
