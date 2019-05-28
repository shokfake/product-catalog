<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryAttributes;
use App\Http\Requests\CategoryRequest;
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
        $categories = Category::latest()->paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::getUsersByRole(User::ADMIN_MANAGERS)->pluck('name', 'id');

        return view('categories.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        $category->setCategoryAttributes($request);
        return redirect()->route('categories.index')->with('success', 'Category has been added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        /** @var Collection $users */
        $users = User::getUsersByRole(User::ADMIN_MANAGERS)->pluck('name', 'id');

        return view('categories.edit', compact('category', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->setCategoryAttributes($request);
        $category->update($request->all());

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
}
