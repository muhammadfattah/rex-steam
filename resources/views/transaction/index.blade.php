@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        <div class="information">
            <div class="sub-information bg-light finish">
                <div class="number"><i class="fa fa-check"></i></div>
                <div class="title">Shopping Cart</div>
            </div>
            <div class="sub-information bg-light active">
                <div class="number">02</div>
                <div class="title">Transaction Information</div>
            </div>
            <div class="sub-information bg-light">
                <div class="number">03</div>
                <div class="title">Transaction Receipt</div>
            </div>
        </div>
        <h1 class="title mb-3">{{ $title }}</h1>
        <form action="/checkout" method="POST" class="tombol-transaction-checkout">
            @csrf
            <input type="hidden" name="total" value="{{ $total }}">
            <div class="mb-2">
                <label for="card_name" class="form-label col-form-label-sm mb-1">Card Name</label>
                <input type="text" class="form-control form-control-sm @error('card_name') is-invalid @enderror"
                    id="card_name" name="card_name" value="{{ old('card_name') }}" placeholder="Card Name">
                @error('card_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="card_number" class="form-label col-form-label-sm mb-1">Card Number</label>
                <input type="text" class="form-control form-control-sm @error('card_number') is-invalid @enderror"
                    id="card_number" name="card_number" value="{{ old('card_number') }}" placeholder="Card Number">
                <div id="card_number_help" class="form-text">VISA or Master Card</div>
                @error('card_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2 row">
                <div class="col-lg-4">
                    <label for="expired_month" class="form-label col-form-label-sm mb-1">Expired Date</label>
                    <input type="text" class="form-control form-control-sm @error('expired_month') is-invalid @enderror"
                        id="expired_month" name="expired_month" value="{{ old('expired_month') }}" placeholder="MM">
                    @error('expired_month')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label for="expired_year" class="form-label col-form-label-sm mb-1" style="opacity: 0">Expired
                        Month</label>
                    <input type="text" class="form-control form-control-sm @error('expired_year') is-invalid @enderror"
                        id="expired_year" name="expired_year" value="{{ old('expired_year') }}" placeholder="YYYY">
                    @error('expired_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label for="cvc" class="form-label col-form-label-sm mb-1">CVC / CVV</label>
                    <input type="text" class="form-control form-control-sm @error('cvc') is-invalid @enderror" id="cvc"
                        name="cvc" value="{{ old('cvc') }}" placeholder="3 or digit number">
                    @error('cvc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-lg-8">
                    <label for="country" class="form-label col-form-label-sm mb-1">Country</label>
                    <select class="form-select form-select-sm @error('country') is-invalid @enderror" id="country"
                        name="country">
                        <option @if (old('country') == '') selected @endif value="">-- Select Country --</option>
                        @foreach ($countries as $country)
                            <option @if (old('country') == $country) selected @endif value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                    @error('country')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label for="zip" class="form-label col-form-label-sm mb-1">ZIP</label>
                    <input type="text" class="form-control form-control-sm @error('zip') is-invalid @enderror" id="zip"
                        name="zip" value="{{ old('zip') }}" placeholder="ZIP">
                    @error('zip')
                        <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center mt-3">
                <div class="total-price text-light me-auto"><i class="fa fa-tag"></i> Total Price:
                    <span class="fw-bold">{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</span>
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">Cancel</a>
                <button type="submit" class="btn btn-dark btn-sm mx-2"><i class="fa fa-truck"></i> Checkout</button>
            </div>
        </form>
    </div>
@endsection
