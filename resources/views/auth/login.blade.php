@extends('layouts.auth.index')
@section('content')
    <div class="background d-flex justify-content-center align-items-center" id="bg">
        <div class="form">
            <h1>Login</h1>
            <form action="/login" method="POST">
                @csrf
                <div class="mb-2">
                    <label for="username" class="form-label col-form-label-sm">Username</label>
                    <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror"
                        id="username" name="username" value="{{ old('username') }}">
                    @error('username')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label col-form-label-sm">Password</label>
                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                        id="password" name="password">
                    @error('password')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check mb-4 mx-2">
                    <input class="form-check-input bg-danger" type="checkbox" id="remember_me" name="remember_me"
                        value="true">
                    <label class="form-check-label" for="remember_me">
                        Remember me
                    </label>
                </div>
                <button class="btn btn-primary btn-sm mb-3">Sign In</button>
            </form>
            <a href="/register">Don't have an account?</a>
        </div>
    </div>
@endsection
