@extends('layouts.app')

@section('title', 'Orders')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Orders</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></div>
                    <div class="breadcrumb-item">All Orders</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Orders</h2>
                <p class="section-lead">
                    You can view all Orders, such as transaction time, amount and more.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Orders</h4>
                            </div>
                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET" action="{{ route('order.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search Date" name="transaction_time">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Transaction Time</th>
                                            <th>Total Price</th>
                                            <th>Pajak (PPN 11%)</th>
                                            <th>Grand Total</th>
                                            <th>Total Item</th>
                                            <th>Payment Method</th>
                                            <th>Nama Kasir</th>
                                        </tr>
                                        <?php $no = 1; ?>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration + $orders->firstItem() - 1 }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('order.show', $order->order_id) }}">{{ $order->transaction_time }}</a>
                                                </td>
                                                <td>
                                                    Rp. {{ number_format(($order->total_price), 0, ",", ".") }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format(($order->total_price * 0.11), 0, ",", ".") }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format(($order->total_price + ($order->total_price * 0.11)), 0, ",", ".") }}
                                                </td>
                                                <td>
                                                    {{ $order->total_item }}
                                                </td>
                                                <td>
                                                    {{ $order->payment_method }}
                                                </td>
                                                <td>
                                                    {{ $order->name }}
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $orders->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
