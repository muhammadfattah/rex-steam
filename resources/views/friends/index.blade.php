@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        <div class="profile row bg-light flex-nowrap">
            <div class="sidebar col-3">
                <ul>
                    <li><a href="/profile"><i class="fa fa-user fa-fw"></i> <span>Profile</span></a>
                    </li>
                    @can('member')
                        <li class="active"><a href="/friends"><i class="fa fa-users fa-fw"></i> <span>Friends</span></a>
                        </li>
                        <li><a href="/transaction-history"><i class="fa fa-history fa-fw"></i>
                                <span>Transaction
                                    History</span></a></li>
                    @endcan
                </ul>
            </div>
            <div class="content col-9">
                <h3 class="title">Friends</h3>
                <div class="friends">
                    <form action="/friends" class="row align-items-end" method="POST">
                        @csrf
                        <div class="col-lg-5 col-8">
                            <label for="name" class="form-label col-form-label-sm mb-1 sub-title">Add Friend</label>
                            <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror"
                                id="username" aria-describedby="username_help" name="username"
                                value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-dark btn-sm px-3">Add</button>
                        </div>
                    </form>
                    <div class="incoming mt-4">
                        <div class="sub-title mb-2">Incoming Friend Request</div>
                        <div class="row">
                            @if (count($incomingRequests) > 0)
                                @foreach ($incomingRequests as $request)
                                    @php $fromUser = $request->fromUser @endphp
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h5 class="card-title">
                                                            {{ $fromUser->fullname }}
                                                            <span class="badge rounded-pill bg-dark ms-1">
                                                                {{ $fromUser->level }}
                                                            </span>
                                                        </h5>
                                                        <h6 class="card-subtitle text-muted">{{ $fromUser->role }}</h6>
                                                    </div>
                                                    <div class="col-4">
                                                        <img
                                                            src="{{ asset('storage' . str_replace('public', '', $fromUser->profile)) }}">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-around mt-3 pt-3 action">
                                                    <form action="/friends/{{ $request->id }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-outline-success btn-sm" type="submit"><i
                                                                class="fa fa-user-plus"></i>
                                                            Accept</button>
                                                    </form>
                                                    <form action="/friends/{{ $request->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm" type="submit"><i
                                                                class="fa fa-user-minus"></i> Reject</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div>There is no incoming friend request.</div>
                            @endif
                        </div>
                    </div>

                    <div class="pending mt-5">
                        <div class="sub-title mb-2">Pending Friend Request</div>
                        <div class="row">
                            @if (count($pendingRequests) > 0)
                                @foreach ($pendingRequests as $request)
                                    @php $toUser = $request->toUser @endphp
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h5 class="card-title">
                                                            {{ $toUser->fullname }}
                                                            <span class="badge rounded-pill bg-dark ms-1">
                                                                {{ $toUser->level }}
                                                            </span>
                                                        </h5>
                                                        <h6 class="card-subtitle text-muted">{{ $toUser->role }}</h6>
                                                    </div>
                                                    <div class="col-4">
                                                        <img
                                                            src="{{ asset('storage' . str_replace('public', '', $toUser->profile)) }}">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-around mt-3 pt-3 action">
                                                    <form action="/friends/{{ $request->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm" type="submit"><i
                                                                class="fa fa-user-minus"></i> Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div>There is no pending friend request.</div>
                            @endif
                        </div>
                    </div>

                    <div class="list-friends mt-5">
                        <div class="sub-title mb-2">Your Friends</div>
                        <div class="row">
                            @if (count($friendList) > 0)
                                @foreach ($friendList as $friend)
                                    @php $user = $friend->user @endphp
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h5 class="card-title">
                                                            {{ $user->fullname }}
                                                            <span class="badge rounded-pill bg-dark ms-1">
                                                                {{ $user->level }}
                                                            </span>
                                                        </h5>
                                                        <h6 class="card-subtitle text-muted">{{ $user->role }}</h6>
                                                    </div>
                                                    <div class="col-4">
                                                        <img
                                                            src="{{ asset('storage' . str_replace('public', '', $user->profile)) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div>There is no friend.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
