@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        <h1 class="title mb-3">{{ $title }}</h1>
        <form action="/manage-game" method="GET">
            <div class="mb-2 col-xl-4 col-md-6 col-sm-8">
                <label for="search" class="form-label col-form-label-sm mb-1">Filter by Games Name</label>
                <input type="search" class="form-control form-control-sm input-search" placeholder="&#xf002;" id="search"
                    name="search" value="{{ request('search') }}">
            </div>
            <div class="">
            <label class=" form-label col-form-label-sm mb-1">Filter by Games
                Category</label>
                <div class="row container-fluid mx-0 px-0 mb-3">
                    <div class="col-md-4 row justify-content-start">
                        @foreach ($categories as $category)
                            <div class="form-check col-4">
                                <input class="form-check-input bg-dark" type="checkbox" id="category_{{ $loop->index }}"
                                    name="category[{{ $loop->index }}]" value="{{ $category }}"
                                    @if (isset(request('category')[$loop->index]) && request('category')[$loop->index] == $category)checked @endif>
                                <label class="form-check-label" for="category_{{ $loop->index }}">
                                    {{ $category }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start align-items-center">
                <button type="submit" class="btn btn-light btn-sm">Search</button>
            </div>
        </form>

        <div class="games row">
            @if (count($games) > 0)
                @foreach ($games as $game)
                    <div class="col-lg-3 col-sm-6">
                        <div class="game">
                            <div class="background"
                                data-url="{{ asset('storage' . str_replace('public', '', $game->cover)) }}">
                            </div>
                            <div class="decription">
                                <div class="title">{{ $game->name }}</div>
                                <div class="category">{{ $game->category }}</div>
                            </div>
                            <div class="action">
                                <a href="/manage-game/{{ $game->id }}/edit" class="btn btn-light btn-sm"><i
                                        class="fa fa-edit"></i> Edit</a>
                                <form method="POST" action="/manage-game/{{ $game->id }}"
                                    class="d-inline-block tombol-hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"
                                            aria-hidden="true"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mt-3 text-light">
                    There are no games content can be showed right now
                </div>
            @endif
        </div>
        {{ $games->links('pagination.custom') }}
        <a class="create-game-button" href="/manage-game/create"><i class="fas fa-plus"></i></a>
    </div>
@endsection
