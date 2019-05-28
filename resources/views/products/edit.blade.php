@extends('layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-11 d-flex align-items-center justify-content-center">
                    <strong>Edit Product</strong>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-outline-info btn-sm" href="{{ route('products.index') }}"> Back</a>

                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="name">Product Name:</label>
                            <input type="text" class="form-control" name="name" value={{ $product->name }} />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <product-attribute :categories="{{$categories}}" :selected="{{$product->category_id}}"
                                               :attributes="{{$attributes}}"></product-attribute>
                        </div>
                    </div>
                    @if(! empty($product->image))
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <img class="card" style="width: 200px;height: 200px;"
                                 src="{{url('uploads/'.$product->image)}}"
                                 alt="{{$product->image}}">
                        </div>
                    @endif
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group custom-file">
                            <input type="file" class="custom-file-input" name="image" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection