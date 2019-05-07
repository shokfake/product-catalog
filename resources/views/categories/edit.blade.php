@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit Category
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('categories.update', $category->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" name="name" value={{ $category->name }} />
                </div>
                <div class="form-group">
                    {!! Form::Label('user', 'Users:') !!}
                    {!! Form::select('user', $users, $category->user_id ?? ' ', ['class' => 'form-control']) !!}
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection