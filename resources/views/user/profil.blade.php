@extends('layouts.master')

@section('title', 'Edit Profil')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0" ><strong>Edit Profil</strong></h5>
    <span class="text-secondary">Dashboard <i class="fa fa-angle-right"></i> Edit Profil</span>
    
    <div class="row mt-3">
        <div class="col-sm-12">
            <!--Datatable-->
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                        <form action="{{ route('user.update_profil') }}" method="post" class="form-profil" data-toggle="validator" enctype="multipart/form-data">
    @csrf
    <div class="box-body">
        <!-- Alert -->
        <div class="alert alert-info alert-dismissible" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-check"></i> Perubahan berhasil disimpan
        </div>

        <!-- Nama -->
        <div class="form-group row">
            <label for="name" class="col-lg-2 control-label">Nama</label>
            <div class="col-lg-6">
                <input type="text" name="name" class="form-control" id="name" required autofocus value="{{ $profil->name }}">
                <span class="help-block with-errors"></span>
            </div>
        </div>

        <!-- Foto Profil -->
        <div class="form-group row">
            <label for="foto" class="col-lg-2 control-label">Profil</label>
            <div class="col-lg-6">
                <div class="custom-file">
                    <input type="file" name="foto" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="preview('.tampil-foto', this.files[0])">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="tampil-foto mt-3">
                    <img src="{{ url($profil->foto ?? '') }}" width="200" alt="Foto Profil">
                </div>
            </div>
        </div>

        <!-- Password Lama -->
        <div class="form-group row">
            <label for="old_password" class="col-lg-2 control-label">Password Lama</label>
            <div class="col-lg-6">
                <input type="password" name="old_password" id="old_password" class="form-control" minlength="6">
                <span class="help-block with-errors"></span>
            </div>
        </div>

        <!-- Password Baru -->
        <div class="form-group row">
            <label for="password" class="col-lg-2 control-label">Password Baru</label>
            <div class="col-lg-6">
                <input type="password" name="password" id="password" class="form-control" minlength="6">
                <span class="help-block with-errors"></span>
            </div>
        </div>

        <!-- Konfirmasi Password Baru -->
        <div class="form-group row">
            <label for="password_confirmation" class="col-lg-2 control-label">Konfirmasi Password Baru</label>
            <div class="col-lg-6">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" data-match="#password">
                <span class="help-block with-errors"></span>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="box-footer text-right">
        <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
    </div>
</form>

<script>
    // Script untuk preview foto saat memilih file
    function preview(target, file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector(target).innerHTML = '<img src="' + e.target.result + '" width="200">';
        };
        reader.readAsDataURL(file);
    }
</script>

                        </div>
                    </div>
                </div>
                
            </div>
            <!--/Datatable-->

        </div>
    </div>

    
@endsection

@push('scripts')
<script>
    $(function () {
        $('#old_password').on('keyup', function () {
            if ($(this).val() != "") $('#password, #password_confirmation').attr('required', true);
            else $('#password, #password_confirmation').attr('required', false);
        });

        $('.form-profil').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.ajax({
                    url: $('.form-profil').attr('action'),
                    type: $('.form-profil').attr('method'),
                    data: new FormData($('.form-profil')[0]),
                    async: false,
                    processData: false,
                    contentType: false
                })
                .done(response => {
                    $('[name=name]').val(response.name);
                    $('.tampil-foto').html(`<img src="{{ url('/') }}${response.foto}" width="200">`);
                    $('.img-profil').attr('src', `{{ url('/') }}/${response.foto}`);

                    $('.alert').fadeIn();
                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 3000);
                })
                .fail(errors => {
                    if (errors.status == 422) {
                        alert(errors.responseJSON); 
                    } else {
                        alert('Tidak dapat menyimpan data');
                    }
                    return;
                });
            }
        });
    });
</script>
@endpush