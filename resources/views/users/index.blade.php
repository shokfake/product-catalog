@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <td colspan="2">Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $role)
                            <label class="badge badge-success">{{ $role }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('users.destroy', $user->id)}}" method="post"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit"> Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    {!! $users->links() !!}


@endsection