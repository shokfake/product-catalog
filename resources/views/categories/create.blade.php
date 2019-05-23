@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Add Category
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            <form method="post" action="{{ route('categories.store') }}">
                <div class="form-group">
                    @csrf
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input id="name" type="text" class="form-control" name="name"/>
                    </div>
                    <div class="form-group">
                        {!! Form::Label('user', 'Users:') !!}
                        {!! Form::select('user', $users, null, ['class' => 'form-control','placeholder' => 'Please Select']) !!}
                    </div>
                    <div class="form-group">
                        <category-attribute/>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection