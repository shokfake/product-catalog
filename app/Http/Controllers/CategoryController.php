<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryAttributes;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = Role::findByName('Admin managers')->users->pluck('name', 'id');
        return view('categories.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
//            'user_id'=>'required',
        ]);

        $category = new Category([
            'name' => $request->get('name'),
            'user_id' => $request->get('user'),
        ]);
        $category->save();

        foreach ($request->get('attributes') as $attribute) {
            $categoryAttribute = new CategoryAttributes();
            $categoryAttribute->name = $attribute;
            $categoryAttribute->category_id = $category->id;
            $categoryAttribute->save();
        }

        return redirect()->route('categories.index')->with('success', 'Category has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

        /** @var Collection $users */
        $users = Role::findByName('Admin managers')->users->pluck('name', 'id');
        /** @var Category $category */
        $category = Category::find($id);

//        dd(\GuzzleHttp\json_encode($category->attributes));
        if (!$users->has($category->user_id)) {
            $users->prepend('Please Select', 0);
        }

        $attributes = \GuzzleHttp\json_encode($category->attributes);
        return view('categories.edit', compact('category', 'users', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->user_id = $request->get('user');
        foreach ($request->get('attributes') as $id => $name) {
            $categoryAttribute = new CategoryAttributes();
            $categoryAttribute->name = $name;
            $categoryAttribute->category_id = $category->id;
            $categoryAttribute->save();
        }
        $category->update();

        return redirect()->route('categories.index')->with('success', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category has been updated');
    }

    public function attributes($id)
    {
        $category = Category::find($id);
        return response()->json($category->attributes, 200);
    }

    public function products($id)
    {
        $category = Category::find($id);
        return response()->json($category->products, 200);
    }
    public function categories()
    {
        return Category::all();
    }
}
