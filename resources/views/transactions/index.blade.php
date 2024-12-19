@extends('layouts.master')

@section('title', 'Riwayat Penjualan')

@section('content')
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0"><strong>Riwayat Penjualan</strong></h5>
    <span class="text-secondary">Transaksi <i class="fa fa-angle-right"></i> Penjualan</span>

    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header py-3 d-flex">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('Penjualan') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover datatable datatable-transaction" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Code</th>
                                        <th>Kasir</th>
                                        <th>Cust. Name</th>
                                        <th>Bayar</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td>{{ $transaction->transaction_code }}</td>
                                        <td>{{ $transaction->nama_kasir }}</td>
                                        <td>{{ $transaction->nama_customer }}</td>
                                        <td>{{ $transaction->metode_bayar }}</td>
                                        <td>Rp.{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $transaction->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">{{ __('Data tidak ditemukan') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus transaksi ini?</p>
            </div>
            <div class="modal-footer">
                <form id="delete-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-alt')
<script>
    $(document).ready(function() {
        // DataTable initialization
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transactions.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'transaction_code', name: 'transaction_code' },
                { data: 'nama_kasir', name: 'nama_kasir' },
                { data: 'nama_customer', name: 'nama_customer' },
                { data: 'metode_bayar', name: 'metode_bayar' },
                { data: 'total_price', name: 'total_price' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Modal delete setup
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var action = "{{ url('transactions') }}/" + id;
            $('#delete-form').attr('action', action);
        });
    });
</script>
@endpush
