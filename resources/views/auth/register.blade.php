@extends('layouts.auth.index')
@section('content')
    <div class="background d-flex justify-content-center align-items-center" id="bg">
        <div class="form">
            <h1>Register</h1>
            <form action="/register" method="POST">
                @csrf
                <div class="mb-2">
                    <label for="username" class="form-label col-form-label-sm">Username</label>
                    <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror"
                        id="username" name="username" value="{{ old('username') }}">
                    @error('username')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="fullname" class="form-label col-form-label-sm">Full Name</label>
                    <input type="text" class="form-control form-control-sm @error('fullname') is-invalid @enderror"
                        id="fullname" name="fullname" value="{{ old('fullname') }}">
                    @error('fullname')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label col-form-label-sm">Password</label>
                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                        id="password" name="password">
                    @error('password')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                        <option @if (old('role') != '') selected @endif value="">-- Select Role --</option>
                        <option @if (old('role') == 'Member') selected @endif value="Member">Member</option>
                        <option @if (old('role') == 'Admin') selected @endif value="Admin">Admin</option>
                    </select>
                    @error('role')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary btn-sm mb-3">Sign Up</button>
            </form>
            <a href="/login">Already have an account?</a>
        </div>
    </div>
@endsection
