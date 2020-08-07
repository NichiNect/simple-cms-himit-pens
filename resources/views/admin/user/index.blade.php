@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('username', Auth::user()->name)

@section('content')
<div class="row">
    <div class="col-lg">
        <h1>User Management</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Admin Role
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $admin }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total User Role
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $user }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
@if (session('message'))
<div class="alert alert-success my-3">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary my-3">
    <i class="fas fa-user"></i>
    Add New User or Admin
</a>
<div class="row">
    <div class="col-lg">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Email</th>
                    <th scope="col">Joined At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; ?>
                @foreach($users as $usr)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $usr->name }}</td>
                    <td>{{ ucwords($usr->role) }}</td>
                    <td>{{ $usr->email }}</td>
                    <td>{{ $usr->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $usr) }}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.users.destroy', $usr->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger text-white" onclick="return confirm('Are you ready to delete this data?');">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>

@endsection