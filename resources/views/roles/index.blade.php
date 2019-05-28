@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-9 d-flex align-items-center justify-content-center ">
            <h2>Roles</h2>
        </div>
        <div class="col-md-3 d-flex align-items-end justify-content-end">
            @can('role-create')
                <a class="btn btn-outline-success" href="{{ route('roles.create') }}"> Create New Role</a>
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
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2">Action</th>
                </tr>
                </thead>
                @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @can('role-edit')
                                <a class="btn btn-outline-success" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                            @endcan
                            @can('role-delete')
                                    <form action="{{ route('roles.destroy', $role->id)}}" method="post"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" type="submit"
                                                @cannot('delete-roles') disabled @endcannot>Delete
                                        </button>
                                    </form>


                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="page-hero d-flex align-items-center justify-content-center">
        {!! $roles->links() !!}
    </div>
@endsection