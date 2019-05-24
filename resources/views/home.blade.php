@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="list-group">
                    <a href="{{route('home')}}" class="list-group-item list-group-item-action active">Categories</a>
                    @foreach ($categories as $category )
                        <a href="{{route('home',['category' => $category->id])}}"
                           class="list-group-item list-group-item-action">
                            {{$category->name}}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4">
                            <card class="card" :product="{{$product}}"></card>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="page-hero d-flex align-items-center justify-content-center">
            {!! $products->links() !!}
        </div>
    </div>
@endsection
