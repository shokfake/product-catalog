@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-9 d-flex align-items-center justify-content-center ">
            <h2>Users</h2>
        </div>
        <div class="col-md-3 d-flex align-items-end justify-content-end">
            @can('create-product')
                <a class="btn btn-outline-success" href="{{ route('users.create') }}"> Create New User</a>
            @endcan
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-lg-12">
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
                            <a href="{{ route('users.edit',$user->id)}}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('users.destroy', $user->id)}}" method="post"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger" type="submit"> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="page-hero d-flex align-items-center justify-content-center">
        {!! $users->links() !!}
    </div>

@endsection