@extends('layouts.master')

@section('title', 'Detail Product')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0" ><strong>Detail Product</strong></h5>
    <span class="text-secondary">Master Data <i class="fa fa-angle-right"></i> Product <i class="fa fa-angle-right"></i> Detail Product</span>
    
    <div class="row mt-3">
        <div class="col-sm-12">
            <!--Datatable-->
            <div class="card">
                <div class="card-body p-3">
                    <p><strong>Kode:</strong> {{ $product->kode_produk }}</p>
                    <p><strong>Nama Produk:</strong> {{ $product->nama_produk }}</p>
                    <p><strong>Kategori:</strong> {{ $product->kategori }}</p>

                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                    @if($product->detailProduct->isEmpty())
                        <p>Belum ada detail produk untuk produk ini.</p>
                    @else
                    <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="datatable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No Produk</th>
                                            <th>Stok</th>
                                            <th>Tgl Expired</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($product->detailProduct as $p)
                                        <tr>
                                            <td>{{ $p->no_produk }}</td>
                                            <td>{{ $p->stok }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->tgl_expired)->format('d-m-Y') }}</td>
                                            <td>
                                                @if (\Carbon\Carbon::parse($p->tgl_expired)->isPast())
                                                    <span class="badge badge-danger">Expired</span>
                                                @else
                                                    <span class="badge badge-success">Valid</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn-sm btn-warning d-inline-block" data-toggle="modal" data-target="#editProductModal{{ $p->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn-sm btn-danger d-inline-block" onclick="deleteConfirm(this); return false;" data-id="{{ $p->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit Data -->
                                        <div class="modal fade" id="editProductModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editProductModalLabel">Edit Detail Produk</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('product.updateDetail', $p->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="no_produk">No Produk</label>
                                                                <input type="text" name="no_produk" class="form-control" value="{{ $p->no_produk }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="stok">Stok</label>
                                                                <input type="number" name="stok" class="form-control" value="{{ $p->stok }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tgl_expired">Tanggal Expired</label>
                                                                <input type="date" name="tgl_expired" class="form-control" value="{{ \Carbon\Carbon::parse($p->tgl_expired)->format('Y-m-d') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Perbarui</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali ke Daftar Produk</a>
                    </div>
                    <!-- Akhir Dari Tabel -->   

                    <!-- Modal Delete Confirmation-->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    x
                                </button>
                            </div>
                            <div class="modal-body" id="xid"></div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
                                
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tambah Data -->
                    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProductModalLabel">Tambah Detail Produk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('product.storeDetail', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="no_produk">No Produk</label>
                                            <input type="text" name="no_produk" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" name="stok" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_expired">Tanggal Expired</label>
                                            <input type="date" name="tgl_expired" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
        <script>
            function deleteConfirm(e){
                var tomboldelete = document.getElementById('btn-delete')  
                id = e.getAttribute('data-id');

                // const str = 'Hello' + id + 'World';
                var url3 = "{{url('detail_product/destroy/')}}";
                var url4 = url3.concat("/",id);
                // console.log(url4);

                // console.log(id);
                // var url = "{{url('product/destroy/"+id+"')}}";
                
                // url = JSON.parse(rul.replace(/"/g,'"'));
                tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

                var pesan = "Data akan dihapus"
                var pesan2 = " permanen"
                var res = id;
                document.getElementById("xid").innerHTML = pesan.concat(pesan2);

                var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {  keyboard: false });
                
                myModal.show();
            
            }
        </script>
@endsection