@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        <div class="profile row bg-light flex-nowrap">
            <div class="sidebar col-3">
                <ul>
                    <li class="active"><a href="/profile"><i class="fa fa-user fa-fw"></i> <span>Profile</span></a>
                    </li>
                    @can('member')
                        <li><a href="/friends"><i class="fa fa-users fa-fw"></i> <span>Friends</span></a></li>
                        <li><a href="/transaction-history"><i class="fa fa-history fa-fw"></i> <span>Transaction
                                    History</span></a></li>
                    @endcan
                </ul>
            </div>
            <div class="content col-9">
                <h3 class="title">{{ auth()->user()->username }} Profile</h3>
                <div class="help">This information will be displayed publicly so be careful what you share.</div>
                <div class="information">
                    <form action="/profile" method="POST" enctype="multipart/form-data" class="update-profile">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-9">
                                    <div class="row mb-2">
                                        <div class="col-9">
                                            <label class="form-label col-form-label-sm mb-1">Username</label>
                                            <input type="text" class="form-control form-control-sm"
                                                value="{{ auth()->user()->username }}" readonly>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label col-form-label-sm mb-1">Level</label>
                                            <input type="text" class="form-control form-control-sm"
                                                value="{{ auth()->user()->level }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="fullname" class="form-label col-form-label-sm mb-1">Full
                                                Name</label>
                                            <input type="text"
                                                class="form-control form-control-sm @error('fullname') is-invalid @enderror"
                                                id="fullname" aria-describedby="fullname_help" name="fullname"
                                                value="{{ old('fullname') ?? auth()->user()->fullname }}">
                                            @error('fullname')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 p-sm-2 d-flex justify-content-center">
                                    <div class="image">
                                        <img
                                            src="{{ asset('storage' . str_replace('public', '', auth()->user()->profile)) }}">
                                        <div>
                                            <i class="fa fa-image"></i>
                                            <span>640 x 640</span>
                                        </div>
                                        <input type="file" id="change-profile" name="profile">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label for="current_password" class="form-label col-form-label-sm mb-1">Current
                                        Password</label>
                                    <input type="password"
                                        class="form-control form-control-sm @error('current_password') is-invalid @enderror"
                                        id="current_password" aria-describedby="current_password_help"
                                        name="current_password">
                                    <div id="current_password_help" class="form-text">Fill out this field to check if
                                        you are
                                        authorized.
                                    </div>
                                    @error('current_password')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label for="new_password" class="form-label col-form-label-sm mb-1">New Password</label>
                                    <input type="password"
                                        class="form-control form-control-sm @error('new_password') is-invalid @enderror"
                                        id="new_password" aria-describedby="new_password_help" name="new_password">
                                    <div id="new_password_help" class="form-text">Only if you want to change your
                                        password.
                                    </div>
                                    @error('new_password')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 mb-2">
                                    <label for="confirm_new_password" class="form-label col-form-label-sm mb-1">
                                        Confirm New Password
                                    </label>
                                    <input type="password"
                                        class="form-control form-control-sm @error('confirm_new_password') is-invalid @enderror"
                                        id="confirm_new_password" aria-describedby="confirm_new_password_help"
                                        name="confirm_new_password">
                                    <div id="confirm_new_password_help" class="form-text">Only if you want to change
                                        your
                                        password.
                                    </div>
                                    @error('confirm_new_password')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2 text-end">
                                    <button type="submit" class="btn btn-dark btn-sm">Update profile</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endsection
