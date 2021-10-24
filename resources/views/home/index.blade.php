@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        <h1 class="title mb-3">{{ $title }}</h1>
        <div class="games row">
            @if (count($games) > 0)
                @foreach ($games as $game)
                    <div class="col-lg-3 col-sm-6">
                        <a href="/{{ Str::slug($game->name) }}">
                            <div class="game">
                                <div class="background"
                                    data-url="{{ asset('storage' . str_replace('public', '', $game->cover)) }}">
                                </div>
                                <div class="decription">
                                    <div class="title">{{ $game->name }}</div>
                                    <div class="category">{{ $game->category }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="mt-3 text-light">
                    There are no games content can be showed right now
                </div>
            @endif
        </div>
        {{ $games->links('pagination.custom') }}
    </div>
@endsection
