@extends('layouts.master')

@section('title', 'List Pesanan')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0" ><strong>List Pesanan</strong></h5>
    <span class="text-secondary">Dashboard <i class="fa fa-angle-right"></i> List Pesanan</span>
    
    <div class="row mt-3">
        <div class="col-sm-12">
                
                
                <div class="container-fluid">
    
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">
                                {{ __('List Product') }}
                                <a href="{{ route('transactions.index') }}" class="btn btn-dark float-right">
                                    <span class="text">{{ __('Go Back') }}</span>
                                </a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="card-responsive">
                                <table class="table mt-3 table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transaction->transaction_details as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product->nama_produk }}</td>
                                                <td>{{ $product->qty }}</td>
                                                <td>Rp. {{number_format($product->base_price) }}</td>
                                                <td>Rp. {{number_format($product->base_total) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">Order product not found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <h3>Total : Rp. {{ number_format($transaction->total_price) }}</h3>
                            <button class="btn btn-success" onclick="notaKecil('{{ route('transactions.print_struck', $transaction->id) }}', 'print_struck')">Print</button>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--/Datatable-->

        </div>

        <script>
            // tambahkan untuk delete cookie innerHeight terlebih dahulu
            document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            
            function notaKecil(url, title) {
                popupCenter(url, title, 625, 500);
            }
        
            function popupCenter(url, title, w, h) {
                const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
                const dualScreenTop  = window.screenTop  !==  undefined ? window.screenTop  : window.screenY;
        
                const width  = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
        
                const systemZoom = width / window.screen.availWidth;
                const left       = (width - w) / 2 / systemZoom + dualScreenLeft
                const top        = (height - h) / 2 / systemZoom + dualScreenTop
                const newWindow  = window.open(url, title, 
                `
                    scrollbars=yes,
                    width  = ${w / systemZoom}, 
                    height = ${h / systemZoom}, 
                    top    = ${top}, 
                    left   = ${left}
                `
                );
        
                if (window.focus) newWindow.focus();
            }
        </script>
    
@endsection

