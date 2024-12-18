@extends('layouts.master')

@section('title', 'COA')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0" ><strong>COA</strong></h5>
    <span class="text-secondary">Master Data <i class="fa fa-angle-right"></i> COA</span>
    
    <div class="row mt-3">
        <div class="col-sm-12">    
            <div class="card">
                <div class="card-body p-3">
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addCoaModal">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>                                                      
                                    <th>Header Akun</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($coa as $p)
                                <tr>
                                    <td>{{ $p->kode_akun }}</td>
                                    <td>{{ $p->nama_akun }}</td>
                                    <td>{{ $p->header_akun }}</td>
                                    <td>
                                        <button class="btn-sm btn-warning d-inline-block" data-toggle="modal" data-target="#editModal{{ $p->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn-sm btn-danger d-inline-block" onclick="deleteConfirm(this); return false;" data-id="{{ $p->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>                                                                                                                                                                
                                    </td>
                                </tr>
                                <!-- Modal untuk Ubah Data -->
                                <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $p->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-default">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $p->id }}">Ubah Data COA</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('coa.update', $p->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                                                                                                                                                            
                                                    <div class="mb-3">
                                                        <label for="kode_akun" class="form-label">Kode Akun:</label>
                                                        <input type="number" class="form-control @error('kode_akun') is-invalid @enderror" id="kode_akun" name="kode_akun" value="{{ old('kode_akun', $p->kode_akun) }}" maxlength="10" required>
                                                        @error('kode_akun')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="nama_akun" class="form-label">Nama Akun:</label>
                                                        <input type="text" class="form-control @error('nama_akun') is-invalid @enderror" id="nama_akun" name="nama_akun" value="{{ old('nama_akun', $p->nama_akun) }}" maxlength="60" required>
                                                        @error('nama_akun')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                
                                                    <div class="mb-3">
                                                        <label for="header_akun" class="form-label">Header Akun:</label>
                                                        <input type="number" class="form-control @error('header_akun') is-invalid @enderror" id="header_akun" name="header_akun" value="{{ old('header_akun', $p->header_akun) }}" maxlength="5" required>
                                                        @error('header_akun')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                            
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary toastrDefaultSuccess">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
                    <div class="modal fade" id="addCoaModal" tabindex="-1" aria-labelledby="addCoaModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-default">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCoaModalLabel">Tambah Data COA</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('coa.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                                                                
                                        <div class="mb-3">
                                            <label for="kode_akun" class="form-label">Kode Akun:</label>
                                            <input type="number" class="form-control @error('kode_akun') is-invalid @enderror" id="kode_akun" name="kode_akun" maxlength="10" required>
                                            @error('kode_akun')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama_akun" class="form-label">Nama Akun:</label>
                                            <input type="text" class="form-control @error('nama_akun') is-invalid @enderror" id="nama_akun" name="nama_akun" maxlength="60" required>
                                            @error('nama_akun')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                
                                        <div class="mb-3">
                                            <label for="header_akun" class="form-label">Header Akun:</label>
                                            <input type="number" class="form-control @error('header_akun') is-invalid @enderror" id="header_akun" name="header_akun" maxlength="5" required>
                                            @error('header_akun')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary toastrDefaultSuccess">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix">
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteConfirm(e){
            var tomboldelete = document.getElementById('btn-delete')  
            id = e.getAttribute('data-id');

            // const str = 'Hello' + id + 'World';
            var url3 = "{{url('coa/destroy/')}}";
            var url4 = url3.concat("/",id);
            // console.log(url4);

            // console.log(id);
            // var url = "{{url('coa/destroy/"+id+"')}}";
            
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