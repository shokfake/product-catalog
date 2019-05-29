@extends('layouts.app')


@section('content')
    <div class="row">
            <div class="col-md-9 d-flex align-items-center justify-content-center ">
                <h2>Products</h2>
            </div>
            <div class="col-md-3 d-flex align-items-end justify-content-end">
                @can('product-create')
                    <a class="btn btn-outline-success" href="{{ route('products.create') }}"> Create New Product</a>
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
                                <img class="card" style="height: 200px; width: 200px"
                                     src="{{url('uploads/'.$product->image)}}" alt="{{$product->image}}">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit',$product->id)}}" class="btn btn-outline-primary
                                                 @cannot('product-edit', [$product]) disabled @endcannot">Edit</a>
                                <form action="{{ route('products.destroy', $product->id)}}" method="post"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit"
                                            @cannot('product-delete') disabled @endcannot>Delete
                                    </button>
                                </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="page-hero d-flex align-items-center justify-content-center">
        {!! $products->links() !!}
    </div>


@endsection
