@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
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

    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            @csrf
            <label for="name">Product Name:</label>
            <input id="name" type="text" class="form-control" name="name"/>
        </div>
        <product-attribute v-bind:categories="{{\GuzzleHttp\json_encode($categories)}}"></product-attribute>
        <div class="form-group">
            <label for="image">Image:</label>
            <input id="image" type="file" class="form-control-file" name="image"/>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>

@endsection