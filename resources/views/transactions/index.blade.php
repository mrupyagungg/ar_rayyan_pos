@extends('layouts.master')

@section('title', 'Riwayat Penjualan')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0" ><strong>Riwayat Penjualan</strong></h5>
    <span class="text-secondary">Transaksi <i class="fa fa-angle-right"></i> Penjualan</span>
    
    <div class="row mt-3">
        <div class="col-sm-12">
            
                
                <div class="container-fluid">

                    <!-- Page Heading -->
                   
                
                    <!-- Content Row -->
                        <div class="card">
                            <div class="card-header py-3 d-flex">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    {{ __('Penjualan') }}
                                </h6>
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
                                            <tr data-entry-id="{{ $transaction->id }}">
              
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transaction->created_at }}</td>
                                                <td>{{ $transaction->transaction_code }}</td>
                                                <td>{{ $transaction->nama_kasir }}</td>
                                                <td>{{ $transaction->nama_customer }}</td>
                                                <td>{{ $transaction->metode_bayar }}</td>
                                                <td>Rp.{{number_format($transaction->total_price )}}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <form onclick="return confirm('are you sure ? ')" class="d-inline" action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="9" class="text-center">{{ __('Data Empty') }}</td>
                                            </tr>
                                            @endforelse      
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <!-- Content Row -->
                
                </div>
                

        </div>
    </div>

    
@endsection


@push('script-alt')
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = 'delete selected'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });
      if (ids.length === 0) {
        alert('zero selected')
        return
      }
      if (confirm('are you sure ?')) {
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  });
  $('.datatable-transaction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endpush