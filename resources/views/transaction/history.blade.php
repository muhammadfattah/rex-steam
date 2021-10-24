@extends('layouts.global.index')
@section('content')
    <div class="bg-gray p-5">
        <div class="profile row bg-light flex-nowrap">
            <div class="sidebar col-3">
                <ul>
                    <li><a href="/profile"><i class="fa fa-user fa-fw"></i> <span>Profile</span></a>
                    </li>
                    @can('member')
                        <li><a href="/friends"><i class="fa fa-users fa-fw"></i> <span>Friends</span></a></li>
                        <li class="active"><a href="/transaction-history">
                                <i class="fa fa-history fa-fw"></i>
                                <span>Transaction History</span>
                            </a></li>
                    @endcan
                </ul>
            </div>
            <div class="content col-9">
                <h3 class="title @if (count($transactions) > 0) mb-4 @endif">{{ $title }}</h3>
                <div class="history">
                    @if (count($transactions) > 0)
                        @foreach ($transactions as $transaction)
                            <div class="transaction">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
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
                                </div>
                                <div class="row ms-1 mb-3 mt-3 mt-lg-0">
                                    @foreach ($transaction->detailTransaction as $detail)
                                        <div class="cover col-lg-3 me-2 mb-3"
                                            data-url="{{ asset('storage' . str_replace('public', '', $detail->game->cover)) }}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="ms-1">Total Price <span
                                        class="fw-bold">{{ 'Rp. ' . number_format($transaction->total, 2, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <span>Your transaction history is empty.</span>
                    @endif
                </div>
            </div>
        </div>
    @endsection
