@extends('layouts.master')

@section('title', 'Supplier')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0" ><strong>Supplier</strong></h5>
    <span class="text-secondary">Master Data <i class="fa fa-angle-right"></i> Supplier</span>
    
    <div class="row mt-3">
        <div class="col-sm-12">    
            <div class="card">
                <div class="card-body p-3">
                    <button type="button" class="btn btn-primary btn-icon-split mb-3" onclick="window.location.href='{{ url('/supplier/create') }}'">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>                    
                      <!-- Awal Dari Tabel -->
                    <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="datatable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Supplier</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Alamat</th>
                                            <th>Contact Person</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($supplier as $p)
                                        <tr>
                                            <td>{{ $p->kode_supplier }}</td>
                                            <td>{{ $p->nama_supplier }}</td>
                                            <td>{{ $p->nama_perusahaan }}</td>
                                            <td>{{ $p->alamat }}</td>
                                            <td>{{ $p->cp }}</td>
                                            <td>
                                                <button type="button" class="btn-sm btn-warning d-inline-block" onclick="window.location.href='{{ route('supplier.edit', $p->id) }}'">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                
                                                <button type="button" class="btn-sm btn-danger d-inline-block" onclick="deleteConfirm(this); return false;" data-id="{{ $p->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>                                              
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    <!-- Akhir Dari Tabel -->
                    </div>
                  </div>
                </div>
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
                
              </div>

        <script>
            function deleteConfirm(e){
                var tomboldelete = document.getElementById('btn-delete')  
                id = e.getAttribute('data-id');

                // const str = 'Hello' + id + 'World';
                var url3 = "{{url('supplier/destroy/')}}";
                var url4 = url3.concat("/",id);
                // console.log(url4);

                // console.log(id);
                // var url = "{{url('supplier/destroy/"+id+"')}}";
                
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