@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-11 d-flex align-items-center justify-content-center">
                    <strong>Edit category</strong>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-outline-info btn-sm" href="{{ route('categories.index') }}"> Back</a>

                </div>
            </div>
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
            <form method="post" action="{{ route('categories.update', $category->id) }}">
               <div class="row">
                   <div class="form-group">
                       @method('PATCH')
                       @csrf
                       <div class="form-group">
                           <label for="name">Category Name:</label>
                           <input type="text" class="form-control" name="name" value={{ $category->name }} />
                       </div>
                       <div class="form-group">
                           <label for="user">Users</label>
                           <select id="user" class="custom-select" name="user_id" placeholder="Please Select">
                               <option value="" hidden>Please Select</option>
                               @foreach($users as $id => $name)
                                   <option value="{{$id}}" {{ ( $category->user->id === $id) ? 'selected':''}}>{{$name}}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="form-group">
                           <category-attribute v-bind:attributes="{{$category->attributes->toJson()}}"></category-attribute>
                       </div>
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                       <button type="submit" class="btn btn-outline-primary">Submit</button>
                   </div>
               </div>
            </form>
        </div>
    </div>
@endsection