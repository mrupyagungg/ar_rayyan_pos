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
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                            data-target="#addProductModal">
                            <i class="fa fa-plus"></i> Tambah Data
                        </button>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="datatable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $p)
                                        <tr>
                                            <td>{{ $p->kode_produk }}</td>
                                            <td>{{ $p->nama_produk }}</td>
                                            <td>{{ $p->kategori }}</td>
                                            <td>{{ rupiah($p->harga_produk) }}</td>
                                            <td>{{ $p->stok }}</td>
                                            <td>
                                                <button type="button" class="btn-sm btn-info d-inline-block"
                                                    onclick="window.location.href='{{ route('detail_product.show', $p->id_produk) }}'">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn-sm btn-warning d-inline-block" data-toggle="modal"
                                                    data-target="#editProductModal{{ $p->id_produk }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn-sm btn-danger d-inline-block"
                                                    onclick="deleteConfirm(this); return false;"
                                                    data-id="{{ $p->id_produk }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editProductModal{{ $p->id_produk }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editProductModalLabel{{ $p->id_produk }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editProductModalLabel{{ $p->id_produk }}">Edit Produk</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('product.update', $p->id_produk) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="kode">Kode Produk</label>
                                                                <input type="text" name="kode_produk"
                                                                    class="form-control" value="{{ $p->kode_produk }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_produk">Nama Produk</label>
                                                                <input type="text" name="nama_produk"
                                                                    class="form-control" value="{{ $p->nama_produk }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kategori">Kategori</label>
                                                                <input type="text" name="kategori" class="form-control"
                                                                    value="{{ $p->kategori }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="harga_produk">Harga Produk</label>
                                                                <input type="number" name="harga_produk"
                                                                    class="form-control" value="{{ $p->harga_produk }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="stok">Stok</label>
                                                                <input type="number" name="stok" class="form-control"
                                                                    value="{{ $p->stok }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Akhir Dari Tabel -->

                        <!-- Modal Delete Confirmation-->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <button class="btn btn-secondary" type="button"
                                            data-dismiss="modal">Cancel</button>
                                        <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Tambah Produk -->
                        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog"
                            aria-labelledby="addProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addProductModalLabel">Tambah Produk</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('product.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="kode">Kode Produk</label>
                                                <input type="text" name="kode_produk" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_produk">Nama Produk</label>
                                                <input type="text" name="nama_produk" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <input type="text" name="kategori" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_produk">Harga Produk</label>
                                                <input type="number" name="harga_produk" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="stok">Stok</label>
                                                <input type="number" name="stok" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
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
            function deleteConfirm(e) {
                var tomboldelete = document.getElementById('btn-delete')
                id = e.getAttribute('data-id');

                // const str = 'Hello' + id + 'World';
                var url3 = "{{ url('product/destroy/') }}";
                var url4 = url3.concat("/", id);
                // console.log(url4);

                // console.log(id);
                // var url = "{{ url('product/destroy/"+id+"') }}";

                // url = JSON.parse(rul.replace(/"/g,'"'));
                tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

                var pesan = "Data akan dihapus"
                var pesan2 = " permanen"
                var res = id;
                document.getElementById("xid").innerHTML = pesan.concat(pesan2);

                var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                    keyboard: false
                });

                myModal.show();

            }
        </script>
    @endsection
@endsection
