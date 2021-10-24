@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        {{-- <h1 class="title mb-3">{{ $title }}</h1> --}}
        <div class="check-age">
            <div class="cover" data-url="{{ asset('storage' . str_replace('public', '', $game->cover)) }}">
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <h3>Content In This Product May Not Be Approriate For All Ages, Or May Not Be Approriate For Viewing At
                        Work
                    </h3>
                </div>
            </div>

            <div class="row mt-3 justify-content-center">
                <div class="col-md-12">
                    <div class="form">
                        <span>Please enter your birth date to continue:</span>
                        <form action="/{{ Str::slug($game->name) }}/check-age" method="POST">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-3 px-1">
                                    <div>
                                        <label for="day" class="form-label col-form-label-sm mb-1">Day</label>
                                        <select class="form-select form-select-sm" id="day" name="day">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5 px-1">
                                    <div>
                                        <label for="month" class="form-label col-form-label-sm mb-1">Month</label>
                                        <select class="form-select form-select-sm" id="month" name="month">
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 px-1">
                                    <div>
                                        <label for="year" class="form-label col-form-label-sm mb-1">Year</label>
                                        <select class="form-select form-select-sm" id="year" name="year">
                                            @for ($i = date('Y'); $i >= 1900; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-dark btn-sm mx-1">View Page</button>
                                <a href="{{ url()->previous() }}" class="btn btn-light btn-sm mx-1">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
