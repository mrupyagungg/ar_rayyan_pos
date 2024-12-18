@extends('layouts.master')

@section('title', 'Supplier')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0" ><strong>Supplier</strong></h5>
    <span class="text-secondary">Master Data <i class="fa fa-angle-right"></i> Supplier</span>
    
    <div class="row mt-3">
        <div class="col-sm-12">
            <!--Datatable-->
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
            <h5 class="card-title fw-semibold mb-4">Data Supplier</h5>

                <!-- Display Error jika ada error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Akhir Display Error -->

                <!-- Awal Dari Input Form -->
                <form action="{{ route('supplier.store') }}" method="post">
                    @csrf
                    <fieldset disabled>
                        <div class="mb-3"><label for="kodesupplierlabel">Kode Supplier</label>
                        <input class="form-control form-control-solid" id="kode_supplier_tampil" name="kode_supplier_tampil" type="text" value="{{$kode_supplier}}" readonly></div>
                    </fieldset>
                    <input type="hidden" id="kode_supplier" name="kode_supplier" value="{{$kode_supplier}}">

                    <div class="mb-3"><label for="namasupplierlabel">Nama Supplier</label>
                    <input class="form-control form-control-solid" id="nama_supplier" name="nama_supplier" type="text" placeholder="Masukkan nama supplier">
                    </div>

                    <div class="mb-3"><label for="namaperusahaanlabel">Nama Perusahaan</label>
                    <input class="form-control form-control-solid" id="nama_perusahaan" name="nama_perusahaan" type="text" placeholder="Masukkan perusahaan supplier">
                    </div>
                    
                    <div class="mb-0"><label for="alamatlabel">Alamat</label>
                        <textarea class="form-control form-control-solid" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat perusahaan supplier"></textarea>
                    </div>

                    <div class="mb-3"><label for="cplabellabel">Contact Person</label>
                    <input class="form-control form-control-solid" id="cp" name="cp" type="number" placeholder="Masukkan nomor telepon">
                    </div>                    

                    <!-- untuk tombol simpan -->
                    
                    <button type="submit" class="col-sm-1 btn btn-primary">Simpan</button>

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-dark" href="{{ url('/supplier') }}" role="button">Batal</a>
                    
                </form>
                <!-- Akhir Dari Input Form -->
            
          </div>
        </div>
      </div>
		
		
		
        
@endsection