<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->with('attributes')->get();
        return response()->json($products);
    }

    public function show(Request $request, Product $product)
    {
        if ($request->user()->cant(Product::GATE_ACTION_WITH_PRODUCT, $product->category_id)) {
            return response()->json([
                'message' => 'you don’t have permission to access'
            ], 403);
        }

        return response()->json($product->getProductsWithCategory());

    }

    public function store(Request $request)
    {
        if ($request->user()->cant(Product::GATE_ACTION_WITH_PRODUCT, $request->get('category_id'))) {
            return response()->json([
                'message' => 'you don’t have permission to access'
            ], 403);
        }

        $product = Product::create($request->all());
        return response()->json($product, 200);
    }

    public function update(Request $request, Product $product)
    {
        if ($request->user()->cant(Product::GATE_ACTION_WITH_PRODUCT, $product->category_id)) {
            return response()->json([
                'message' => 'you don’t have permission to access'
            ], 403);
        }

        $product->update($request->all());
        return response()->json($product, 200);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request, Product $product)
    {
        if ($request->user()->cant(Product::GATE_ACTION_WITH_PRODUCT, $product->category_id)) {
            return response()->json([
                'message' => 'you don’t have permission to access'
            ], 403);
        }

        $product->delete();

        return response()->json(null, 204);
    }
}
