@extends('layouts.app')

@section('content')
    <home-page :products="{{$products}}" :categories ="{{$categories}}"/>
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-lg-13-24 col-sm-12 order-3 order-lg-2">--}}
{{--                <form action="#">--}}
{{--                    <div class="input-group w-100">--}}
{{--                        <select class="custom-select" name="category_name">--}}
{{--                            @foreach($categories as $category)--}}
{{--                                <option value="">All type</option>--}}
{{--                                <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <input type="text" class="form-control" style="width:60%;" placeholder="Search">--}}

{{--                        <div class="input-group-append">--}}
{{--                            <button class="btn btn-primary" type="submit">--}}
{{--                                <i class="fa fa-search"></i>--}}
{{--                            </button>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form> <!-- search-wrap .end// -->--}}
{{--            </div> <!-- col.// -->--}}
{{--        </div>--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                @foreach($products as $product)--}}
{{--                    <div class="col-md-3">--}}
{{--                        <figure class="card card-sm card-product">--}}
{{--                            <div class="img-wrap"><img  src="{{url('uploads/'.$product->image)}}" alt="{{$product->image}}"></div>--}}
{{--                            <figcaption class="info-wrap text-center">--}}
{{--                                <h4 class="title">{{$product->name}}</h4>--}}
{{--                            </figcaption>--}}
{{--                        </figure> <!-- card // -->--}}
{{--                    </div> <!-- col // -->--}}
{{--                @endforeach--}}
{{--            </div> <!-- row.// -->--}}
{{--        </div>--}}

{{--    </div>--}}

@endsection
