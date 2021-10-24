@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        {{-- <h1 class="title mb-3">{{ $title }}</h1> --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $game->category }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $game->name }}</i></li>
            </ol>
        </nav>

        <div class="container-fluid">
            <div class="row detail-game mt-4 justify-content-between">
                <div class="col-md-4 mb-3">
                    <div class="cover"
                        data-url="{{ asset('storage' . str_replace('public', '', $game->cover)) }}">
                    </div>
                    <h3 class="title-game">{{ $game->name }}</h3>
                    <p class="description-game">{{ $game->description }}</p>
                    <p class="other"><span>Genre:</span> {{ $game->category }}</p>
                    <p class="other"><span> Release Date:</span>
                        {{ date('F j, Y', strtotime($game->created_at)) }}</p>
                    <p class="other"><span>Developer:</span> {{ $game->developer }}</p>
                    <p class="other"><span>Publisher:</span> {{ $game->publisher }}</p>
                </div>
                <div class="col-md-8">
                    <video src="{{ asset('storage' . str_replace('public', '', $game->trailer)) }}" controls>
                    </video>
                    @if (auth()->check() && auth()->user()->id !== $game->user_id)
                        <div class="bg-light buy-game">
                            Buy {{ $game->name }}
                            <div class="description">
                                <div class="price">{{ 'Rp. ' . number_format($game->price, 2, ',', '.') }}</div>
                                <form action="/shopping-cart/{{ $game->id }}" class="d-inline-block tombol-add-cart"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="add-cart-button"><i class="fa fa-shopping-cart"></i> Add to
                                        cart</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    @guest
                        <div class="bg-light buy-game">
                            Buy {{ $game->name }}
                            <div class="description">
                                <div class="price">{{ 'Rp. ' . number_format($game->price, 2, ',', '.') }}</div>
                                <form action="/shopping-cart/{{ $game->id }}" class="d-inline-block tombol-add-cart"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="add-cart-button"><i class="fa fa-shopping-cart"></i> Add to
                                        cart</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
            <div class="row long-description">
                <h3>About This Game</h3>
                <p>
                    {{ $game->long_description }}
                </p>
            </div>
        </div>
    </div>
@endsection
