@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


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
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" name="name" value={{ $product->name }} />
        </div>
        <div class="form-group">
            {!! Form::Label('category', 'Categories:') !!}
            {!! Form::select('category', $categories, $product->category_id, ['class' => 'form-control']) !!}
        </div>
        @if(! empty($product->filename))
            <img class="card" style="width: 200px;height: 200px;" src="{{url('uploads/'.$product->filename)}}" alt="{{$product->filename}}">
        @endif
        <div class="form-group">
            <label for="image">Image:</label>
            <input id="image" type="file" class="form-control-file" name="image" value="{{$product->filename}}"/>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection