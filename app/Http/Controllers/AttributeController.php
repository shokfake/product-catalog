<?php

namespace App\Http\Controllers;

use App\CategoryAttributes;
use App\Http\Requests\AttributeRequest;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function update(AttributeRequest $request, int $id)
    {
        $attribute = CategoryAttributes::updateOrCreate(['id' => $id],
            [
                'name' => $request->get('name')
            ]);
        return response()->json($attribute, 200);
    }

    public function delete(int $id)
    {
        CategoryAttributes::find($id)->delete();
        return response()->json(null, 204);
    }
}
