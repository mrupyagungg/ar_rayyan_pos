@extends('layouts.master')

@section('title', 'Retur')

@section('content')

<!-- Sweet Alert -->
@if(isset($status_hapus))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Hapus Data Berhasil',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        </script>
@endif

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
<h5 class="mb-0" ><strong>Retur Pembelian</strong></h5>
    <a href=""><span class="text-secondary">Dashboard <i class="fa fa-angle-right"></i> Pembelian</span></a>
    
    <div class="row mt-3">
        <div class="col-sm-12">
            <!--Datatable-->
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                <h6 class="mb-2">Retur Pembelian </h6>
               
        <div class="card-body" id="show_all_Returs">
          
        <!-- Tombol untuk memicu modal -->
        <button class="btn btn-primary tampilmodaltambah" data-toggle="modal" data-target="#ubahModal">
            Tambah Data
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="labelmodalubah" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelmodalubah">Pengembalian Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" class="formubahRetur" method="post">
                    <div class="modal-body">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="kode_Retur">Kode Retur</label>
                            <input type="text" class="form-control" id="kode_Retur" name="kode_Retur" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_bayar">Tanggal Bayar</label>
                            <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" class="form-control" id="total" name="total" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            // Event saat tombol modal diklik
            $('.tampilmodaltambah').on('click', function() {
                $('#labelmodalubah').html('Tambah Data');
                $('.formubahRetur').attr('action', '/url-aksi-tambah'); // Ganti dengan URL aksi
                $('#kode_Retur, #tanggal_bayar, #keterangan, #harga, #quantity, #total').val('');
            });

            // Menghitung total secara otomatis
            $('#harga, #quantity').on('input', function() {
                const harga = parseFloat($('#harga').val()) || 0;
                const quantity = parseFloat($('#quantity').val()) || 0;
                $('#total').val(harga * quantity);
            });
        });
    </script>
        </div>
    </div>

</div>

@endsection