<?php

namespace App\Http\Controllers\Api;

use App\CategoryAttributes;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    public function delete(CategoryAttributes $attribute)
    {
        $attribute->delete();
        return response()->json(null, 204);
    }
}
