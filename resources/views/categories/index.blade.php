@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-md-9 d-flex align-items-center justify-content-center ">
            <h2>Categories</h2>
        </div>
        <div class="col-md-3 d-flex align-items-end justify-content-end">
            @can('category-create')
                <a class="btn btn-outline-success" href="{{ route('categories.create') }}"> Create category</a>
            @endcan
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-lg-12">
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
                                <a href="{{ route('categories.edit',$category->id)}}" class="btn btn-outline-primary">Edit</a>
                            @endcan
                            @can('category-delete')
                                <form action="{{ route('categories.destroy', $category->id)}}" method="post"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! $categories->links() !!}
    </div>

@endsection