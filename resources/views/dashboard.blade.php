@extends('layouts.master')

@section('title', 'Product')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">

<h5 class="mb-3"><strong>Dashboard</strong></h5>

<h3 class="mb-3"><strong>Selamat Datang di Aplikasi Ar-Rayyan POS!</strong></h3>

<!--Dashboard widget-->
<div class="mt-1 mb-3 button-container">
    <div class="row pl-0">
        <!-- Penjualan Hari Ini -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h4 class="mt-0 mb-0"><strong>{{ rupiah($revenuetoday) }}</strong></h4>
                        <p><small class="text-muted bc-description">Penjualan Hari Ini</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Hari Ini -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger">
                        <i class="fa fa-exchange"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h4 class="mt-0 mb-0"><strong>0</strong></h4>
                        <p><small class="text-muted bc-description">Transaksi Hari Ini</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Penjualan Bulan Ini -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h4 class="mt-0 mb-0"><strong>{{ rupiah($total_revenue) }}</strong></h4>
                        <p><small class="text-muted bc-description">Penjualan Bulan Ini</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Produk Per Kategori -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="bg-theme border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-white">
                        <i class="fa fa-tags text-theme"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h4 class="mt-0 mb-0"><strong>0</strong></h4>
                        <p><small class="bc-description text-white">Total Produk Per Kategori</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pemasok -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="bg-theme border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-white">
                        <i class="fa fa-link text-theme"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h4 class="mt-0 mb-0"><strong>{{ $supplier }}</strong></h4>
                        <p><small class="bc-description text-white">Total Pemasok</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pembelian Produk -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h4 class="mt-0 mb-0"><strong>{{ rupiah(0) }}</strong></h4>
                        <p><small class="text-muted bc-description">Pembelian Produk</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
