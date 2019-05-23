<?php

namespace App\Http\Controllers;

use App\CategoryAttributes;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function show(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $attribute = CategoryAttributes::find($id);
        $attribute->name = $request->get('name');
        $attribute->update();
        return response()->json($attribute, 200);
    }
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $attribute = CategoryAttributes::find($id);
        $attribute->name = $request->get('name');
        $attribute->update();
        return response()->json($attribute, 200);
    }

    public function delete(int $id)
    {
        $attribute = CategoryAttributes::find($id);
        $attribute->delete();

        return response()->json(null, 204);
    }
}
