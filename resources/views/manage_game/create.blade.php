@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        <h1 class="title mb-3">{{ $title }}</h1>
        <form action="/manage-game" method="POST" enctype="multipart/form-data" class="tombol-simpan">
            @csrf
            <div class="mb-2">
                <label for="name" class="form-label col-form-label-sm mb-1">Game Name</label>
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name"
                    aria-describedby="name_help" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="description" class="form-label col-form-label-sm mb-1">Game Description</label>
                <textarea name="description" id="description" rows="2"
                    class="form-control form-control-sm @error('description') is-invalid @enderror"
                    ria-describedby="description_help">{{ old('description') }}</textarea>
                <div id="description_help" class="form-text">Write a single sentence about the game</div>
                @error('description')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="long_description" class="form-label col-form-label-sm mb-1">Game Long Description</label>
                <textarea name="long_description" id="long_description" rows="5"
                    class="form-control form-control-sm @error('long_description') is-invalid @enderror"
                    ria-describedby="long_description_help">{{ old('long_description') }}</textarea>
                @error('long_description')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="category" class="form-label col-form-label-sm mb-1">Game Category</label>
                <select class="form-select form-select-sm @error('category') is-invalid @enderror" id="category"
                    name="category">
                    <option @if (old('category') == '') selected @endif value="">-- Select Game Category --</option>
                    @foreach ($categories as $category)
                        <option @if (old('category') == $category) selected @endif value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="developer" class="form-label col-form-label-sm mb-1">Game Developer</label>
                <input type="text" class="form-control form-control-sm @error('developer') is-invalid @enderror"
                    id="developer" aria-describedby="developer_help" name="developer" value="{{ old('developer') }}">
                @error('developer')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="publisher" class="form-label col-form-label-sm mb-1">Game Publisher</label>
                <input type="text" class="form-control form-control-sm @error('publisher') is-invalid @enderror"
                    id="publisher" aria-describedby="publisher_help" name="publisher" value="{{ old('publisher') }}">
                @error('publisher')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="price" class="form-label col-form-label-sm mb-1">Game Price</label>
                <input type="number" class="form-control form-control-sm @error('price') is-invalid @enderror" id="price"
                    aria-describedby="price_help" name="price" value="{{ old('price') }}">
                @error('price')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="cover" class="form-label col-form-label-sm mb-1">Game Cover</label>
                <input type="file" class="form-control-file @error('cover') is-invalid @enderror" id="cover"
                    data-title="Drag and drop your file or click in this area ( JPG up to 100KB )"
                    aria-describedby="cover_help" name="cover">
                @error('cover')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="trailer" class="form-label col-form-label-sm mb-1">Game Trailer</label>
                <input type="file" class="form-control-file @error('trailer') is-invalid @enderror" id="trailer"
                    data-title="Drag and drop your file or click in this area ( WEBM up to 100KB )"
                    aria-describedby="trailer_help" name="trailer">
                @error('trailer')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input bg-dark" type="checkbox" id="for_adult" name="for_adult" value="true"
                    @if (old('for_adult') == 'true') checked @endif>
                <label class="form-check-label" for="for_adult">
                    Only for adult?
                </label>
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <a href="/manage-game" class="btn btn-light btn-sm">Cancel</a>
                <button type="submit" class="btn btn-dark btn-sm mx-2">Save</button>
            </div>
        </form>
    </div>
@endsection
