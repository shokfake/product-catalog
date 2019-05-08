@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
                @can('create-product')
                    <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
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
            <td>Product Name</td>
            <td>Category</td>
            <td>Image</td>
            <td colspan="2">Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{($product->category) ? $product->category->name : ''}}</td>
                <td>
                    @if($product->image)
                        <img class="card" style="height: 200px; width: 200px" src="{{url('uploads/'.$product->image)}}" alt="{{$product->image}}">
                    @endif
                </td>
                <td>
                        <a href="{{ route('products.edit',$product->id)}}" class="btn btn-primary
                                                 @cannot('update-product', [$product]) disabled @endcannot">Edit</a>

                    @can('delete-product')
                        <form action="{{ route('products.destroy', $product->id)}}" method="post"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"
                                    @cannot('delete-product') disabled @endcannot>Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    {!! $products->links() !!}


@endsection