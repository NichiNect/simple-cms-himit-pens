@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('username', Auth::user()->name)

@section('content')
<div class="row">
    <div class="col-lg">
        <h1>Add New User</h1>
    </div>
</div>

@if (session('message'))
<div class="alert alert-success my-3">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card mt-3">
            <div class="card border-primary">
                <div class="card-header bg-transparent border-primary">To create an account you just following to complete this form</div>
                <div class="card-body text-muted">
                    <form action="{{ route('admin.users.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" placeholder="name..">
                                @error('name')
                                <small class="form-text text-danger ml-2">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select name="role" class="custom-select mr-sm-2 @error('role') is-invalid @enderror" id="role">
                                    <option selected disabled>Choose the role..</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                                @error('role')
                                <small class="form-text text-danger ml-2">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="email@example.com">
                                @error('email')
                                <small class="form-text text-danger ml-2">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" placeholder="password..">
                                @error('password')
                                <small class="form-text text-danger ml-2">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm">
                                <button type="submit" name="submit" class="btn btn-outline-primary float-right"><i class="fas fa-user"></i> Create New Account</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="card-footer bg-transparent border-primary">Footer</div> -->
            </div>
        </div>
    </div>
</div>

@endsection