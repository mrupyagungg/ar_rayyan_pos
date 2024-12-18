@extends('layouts.master')

@section('title', 'Product')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0"><strong>Product</strong></h5>
    <span class="text-secondary">Master Data <i class="fa fa-angle-right"></i> Product</span>

    <div class="row mt-3">
        <div class="col-sm-12">
            <!--Datatable-->
            <div class="card">
                <div class="card-body p-3">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Supplier</th>
                                    <th>Produk</th>
                                    <th>Quantity</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchase as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->supplier->name ?? 'Tidak diketahui' }}</td>
                                        <td>{{ $p->product->name ?? 'Tidak diketahui' }}</td>
                                        <td>{{ $p->quantity }}</td>
                                        <td>{{ $p->created_at ? $p->created_at->format('d-m-Y') : 'Tidak diketahui' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada transaksi pembelian.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Tambah Data -->
                    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProductModalLabel">Tambah Data Pembelian</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('purchase.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="supplier">Supplier</label>
                                            <select class="form-control" id="supplier" name="supplier_id" required>
                                                <option value="">Pilih Supplier</option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="product">Produk</label>
                                            <select class="form-control" id="product" name="product_id" required>
                                                <option value="">Pilih Produk</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection