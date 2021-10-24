@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        <div class="information">
            <div class="sub-information bg-light finish">
                <div class="number"><i class="fa fa-check"></i></div>
                <div class="title">Shopping Cart</div>
            </div>
            <div class="sub-information bg-light finish">
                <div class="number"><i class="fa fa-check"></i></div>
                <div class="title">Transaction Information</div>
            </div>
            <div class="sub-information bg-light active">
                <div class="number">03</div>
                <div class="title">Transaction Receipt</div>
            </div>
        </div>
        <h1 class="title mb-3">{{ $title }}</h1>
        <div class="carts row bg-light p-4">
            <table>
                <tr>
                    <td>Transaction ID</td>
                    <td>:</td>
                    <td>{{ $transaction->receipt_id }}</td>
                </tr>
                <tr>
                    <td>Purchased Date</td>
                    <td>:</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            </table>
            <div class="border-receipt"></div>
            @if (count($detailTransaction) > 0)
                @foreach ($detailTransaction as $detail)
                    @php $item = $detail->game; @endphp
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
                    </div>
                @endforeach
                <div class="d-flex ">
                    <div class=" total-price mt-3 text-start"><i class="fa fa-tag"></i>
                        Total Price:
                        <span class="fw-bold">{{ 'Rp. ' . number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                    <a href="/" class="btn btn-dark btn-sm checkout ms-auto me-3 mt-3"><i class="fa fa-home"></i>
                        Back to home</a>
                </div>
            @endif
        </div>
    </div>
@endsection
