<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/css/global.css">

    <title>{{ $title }}</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2">
        <div class="container mx-auto px-4">
            <a class="navbar-brand" href="/">ReXsteam</a>
            <form class="form-search nav-mobile" action="/games" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" type="search" placeholder="Search..."
                        name="search" @if (request()->is('*') && !(request()->is('manage-game') || request()->is('manage-game/*'))) value="{{ request('search') }}" @endif>
                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
            @can('member')
                <a href="/shopping-cart" class="text-light me-3 cart-mobile"><i class="fa fa-shopping-cart"></i></a>
            @endcan
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto text-center">
                    <a class="nav-link @if (request()->is('*') && !(request()->is('manage-game') || request()->is('manage-game/*'))) active @endif" href="/">Home</a>
                    @auth
                        @can('admin')
                            <a class="nav-link @if (request()->is('manage-game') || request()->is('manage-game/*')) active @endif" href="/manage-game">Manage Game</a>
                        @endcan
                    @endauth
                    @guest
                        <a class="btn btn-danger btn-sm mb-2 mx-auto" style="width: 90%;" href="/login">Login</a>
                        <a class="btn btn-danger btn-sm mb-3 mx-auto" style="width: 90%;" href="/register">Register</a>
                    @endguest
                    @auth
                        <div class="dropdown mb-2">
                            <img src="{{ asset('storage' . str_replace('public', '', auth()->user()->profile)) }}"
                                class="photo-profile dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                            </button>
                            <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                @can('member')
                                    <li><a class="dropdown-item" href="/friends">Friends</a></li>
                                    <li><a class="dropdown-item" href="/transaction-history">Transaction History</a></li>
                                @endcan
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="POST" class="tombol-signout">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Sign Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth
            </div>
            <div class="d-flex align-items-center nav-desktop">
                <form class="form-search mx-3" action="/games" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" type="search" placeholder="Search..."
                            name="search" @if (request()->is('*') && !(request()->is('manage-game') || request()->is('manage-game/*'))) value="{{ request('search') }}" @endif>
                        <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                @auth
                    @can('member')
                        <a href="/shopping-cart" class="text-light"><i class="fa fa-shopping-cart"></i></a>
                    @endcan
                    <div class="dropdown mx-3">
                        <img src="{{ asset('storage' . str_replace('public', '', auth()->user()->profile)) }}"
                            class="photo-profile dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                        </button>
                        <ul class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            @can('member')
                                <li><a class="dropdown-item" href="/friends">Friends</a></li>
                                <li><a class="dropdown-item" href="/transaction-history">Transaction History</a></li>
                            @endcan
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="POST" class="tombol-signout">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Sign Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
                @guest
                    <div class="d-flex justify-content-center align-items-center">
                        <a class="btn btn-danger btn-sm mx-1" href="/login">Login</a>
                        <a class="btn btn-danger btn-sm mx-1" href="/register">Register</a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
