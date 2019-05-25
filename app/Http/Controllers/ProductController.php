<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryAttributes;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductAttributesValue;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @param Request $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
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

        foreach ($request->get('attributes') as $value) {
            ProductAttributesValue::updateOrCreate(['product_id' => $product->id, 'category_attribute_id' => $value['id']], [
                'product_id' => $product->id,
                'category_attribute_id' => $value['id'],
                'value' => $value['value'],
            ]);

        }


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
        $categories = Category::getCategoriesByUser($user)->toJson();
        $attributes = CategoryAttributes::getAttributesByProduct($product);
//        dd($attributes);
        return view('products.edit', compact('product', 'categories', 'attributes'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Response
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

        foreach ($request->get('attributes') as $value) {
            ProductAttributesValue::updateOrCreate(['product_id' => $product->id, 'category_attribute_id' => $value['id']], [
                'product_id' => $product->id,
                'category_attribute_id' => $value['id'],
                'value' => $value['value'],
            ]);
        }

        $product->save();


        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        $product->delete();


        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function attributes($id)
    {
        $product = Product::find($id);
        $attributes = DB::table('product_attributes_values')
            ->join('category_attributes', 'product_attributes_values.category_attribute_id', '=', 'category_attributes.id')
            ->join('products', 'product_attributes_values.product_id', '=', 'products.id')
            ->where('product_attributes_values.product_id', $product->id)
            ->select('product_attributes_values.*', 'category_attributes.name', 'product_attributes_values.value')
            ->get('name', 'value');
        return response()->json($attributes, 200);
    }
}
