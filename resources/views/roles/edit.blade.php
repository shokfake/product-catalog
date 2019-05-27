@extends('layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-11 d-flex align-items-center justify-content-center">
                    <strong>Edit Role</strong>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-outline-info btn-sm" href="{{ route('roles.index') }}"> Back</a>

                </div>
            </div>
        </div>
        <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


                <form method="post" action="{{ route('roles.update', $role->id) }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf  <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        @csrf
                        <label for="name">Name:</label>
                        <input id="name" type="text" class="form-control" placeholder="Name" name="name" value="{{$role->name}}"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label class="">Permission:</label><br>
                        @foreach($permission as $value)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$value->value}}" name="permission[]" {{in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="{{$value->value}}">{{$value->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection