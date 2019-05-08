<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Role::findByName('Admin managers')->users->pluck('name', 'id');
        return view('categories.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $category = new Category([
            'name' => $request->get('name'),
            'user_id' => $request->get('user'),
        ]);
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /** @var Collection $users */
       $users = Role::findByName('Admin managers')->users->pluck('name', 'id');
        /** @var Category $category */
        $category = Category::find($id);

        if (! $users->has($category->user_id)) {
            $users->prepend('Please Select','');
        }


        return view('categories.edit',compact('category','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->user_id = $request->get('user');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
//        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category has been updated');
    }
}
