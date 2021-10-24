@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        <div class="information">
            <div class="sub-information bg-light active">
                <div class="number">01</div>
                <div class="title">Shopping Cart</div>
            </div>
            <div class="sub-information bg-light">
                <div class="number">02</div>
                <div class="title">Transaction Information</div>
            </div>
            <div class="sub-information bg-light">
                <div class="number">03</div>
                <div class="title">Transaction Receipt</div>
            </div>
        </div>
        <h1 class="title mb-3">{{ $title }}</h1>
        <div class="carts row bg-light p-4">
            @if (count($carts) > 0)
                @php $total = 0; @endphp
                @foreach ($carts as $cart)
                    @php
                        $item = $cart->game;
                        $total += $item->price;
                    @endphp
                    <div class="cart col-12 d-flex align-items-center">
                        <div class="cover"
                            data-url="{{ asset('storage' . str_replace('public', '', $item->cover)) }}">
                        </div>
                        <div class="decription">
                            <div class="title">{{ $item->name }} <span
                                    class="badge rounded-pill bg-secondary">{{ $item->category }}</span></div>
                            <div class="price"><i class="fa fa-tag"></i>
                                {{ 'Rp. ' . number_format($item->price, 0, ',', '.') }}</div>
                        </div>
                        @if ($item->deleted_admin)
                            <div class="deleted-admin text-secondary">
                                (Deleted by admin)
                            </div>
                        @endif
                        <form action="/shopping-cart/{{ $cart->id }}" class="d-inline-block ms-auto delete-cart"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                Delete</button>
                        </form>
                    </div>
                @endforeach
                <div class="total-price mt-3 text-end"><i class="fa fa-tag"></i> Total Price:
                    <span class="fw-bold">{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</span>
                </div>
                <a href="/checkout" class="btn btn-dark btn-sm checkout ms-auto me-3 mt-3"><i class="fa fa-truck"></i>
                    Checkout</a>
            @else
                <div class="text-dark fw-bold">
                    There are no items in the shopping cart
                </div>
            @endif
        </div>
    </div>
@endsection
