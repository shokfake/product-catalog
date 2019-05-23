@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Category Management</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-striped">
        <thead>
        <tr>
            <td>ID</td>
            <td>Category Name</td>
            <td>User Name</td>
            <td width="280px">Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{($category->user) ? $category->user->name : ''}}</td>
                <td>
                    @can('category-edit')
                        <a href="{{ route('categories.edit',$category->id)}}" class="btn btn-primary">Edit</a>
                    @endcan
                    @can('category-delete')
                        <form action="{{ route('categories.destroy', $category->id)}}" method="post"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>




@endsection