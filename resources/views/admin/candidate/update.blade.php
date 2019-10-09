@extends('templates.master')

@push('css')
    <link href="{{ asset('lib/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/select2/css/select2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="content content-fixed bd-b">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="#">Kandidat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0">Edit Kandidat</h4>
            </div>
            <a href="{{ route('admin.candidate.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
        </div>
    </div><!-- container -->
</div><!-- content -->
<div class="content">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="alerts" id="alerts">

        </div>
        <div class="card tx-black">
            <div data-label="Edit Kandidat" class="df-example demo-table">
                <form method="post" action="{{ route('admin.candidate.update') }}" enctype="multipart/form-data" id="form_update">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $candidate->id }}">
                    <fieldset class="form-fieldset mt-3">
                        <legend>Ketua</legend>
                        <div class="form-group row">
                            <label for="name_ketua" class="col-sm-2 col-form-label">Nama Ketua</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name_ketua" name="name_ketua" placeholder="Nama Ketua" value="{{ $ketua->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class_ketua" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="class_ketua" name="class_ketua">
                                    <option value="X" @if ($ketua->class == 'X') selected @endif>X</option>
                                    <option value="XI" @if ($ketua->class == 'XI') selected @endif>XI</option>
                                    <option value="XII" @if ($ketua->class == 'XII') selected @endif>XII</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="majors_ketua" class="col-form-label col-sm-2 pt-0">Jurusan</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="majors_ketua" name="majors_ketua">
                                    <option value="AKL" @if ($ketua->majors == 'AKL') selected @endif>AKL</option>
                                    <option value="OTKP" @if ($ketua->majors == 'OTKP') selected @endif>OTKP</option>
                                    <option value="BDP" @if ($ketua->majors == 'BDP') selected @endif>BDP</option>
                                    <option value="UPW" @if ($ketua->majors == 'UPW') selected @endif>UPW</option>
                                    <option value="RPL" @if ($ketua->majors == 'RPL') selected @endif>RPL</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender_ketua" class="col-form-label col-sm-2 pt-0">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="gender_ketua" name="gender_ketua">
                                    <option value="L" @if ($ketua->gender == 'L') selected @endif>Laki - laki</option>
                                    <option value="P" @if ($ketua->gender == 'P') selected @endif>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="picture_ketua" class="col-form-label col-sm-2 pt-0">Foto</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="picture_ketua" name="picture_ketua" onchange="showPreview(this, 'preview_photo_ketua')">
                                    <label class="custom-file-label" for="customFile">Pilih File</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="before_picture_ketua" class="col-form-label col-sm-2 pt-0">Foto Sebelumnya</label>
                            <div class="col-sm-4">
                                <img src="{{ asset('uploads/'.$ketua->picture) }}" alt="" class="img-thumbnail" width="200">
                            </div>
                            <label for="preview_picture_ketua" class="col-form-label col-sm-2 pt-0">Foto Baru</label>
                            <div class="col-sm-4">
                                <img src="" alt="" id="preview_photo_ketua" class="img-thumbnail" width="200">
                            </div>
                        </div>

                    </fieldset>
                    <fieldset class="form-fieldset mt-3">
                        <legend>Wakil</legend>
                        <div class="form-group row">
                            <label for="name_wakil" class="col-sm-2 col-form-label">Nama Wakil</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name_wakil" name="name_wakil" placeholder="Nama Wakil" value="{{ $wakil->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class_wakil" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="class_wakil" name="class_wakil">
                                    <option value="X" @if ($wakil->class == 'X') selected @endif}}>X</option>
                                    <option value="XI" @if ($wakil->class == 'XI') selected @endif}>XI</option>
                                    <option value="XII" @if ($wakil->class == 'XII') selected @endif>XII</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="majors_wakil" class="col-form-label col-sm-2 pt-0">Jurusan</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="majors_wakil" name="majors_wakil">
                                    <option value="AKL" @if ($wakil->majors == 'AKL') selected @endif>AKL</option>
                                    <option value="OTKP" @if ($wakil->majors == 'OTKP') selected @endif>OTKP</option>
                                    <option value="BDP" @if ($wakil->majors == 'BDP') selected @endif>BDP</option>
                                    <option value="UPW" @if ($wakil->majors == 'UPW') selected @endif>UPW</option>
                                    <option value="RPL" @if ($wakil->majors == 'RPL') selected @endif>RPL</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender_wakil" class="col-form-label col-sm-2 pt-0">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="gender_wakil" name="gender_wakil">
                                    <option value="L" @if ($wakil->gender == 'L') selected @endif>Laki - laki</option>
                                    <option value="P" @if ($wakil->gender == 'P') selected @endif>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="picture_wakil" class="col-form-label col-sm-2 pt-0">Foto</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="picture_wakil" name="picture_wakil" onchange="showPreview(this, 'preview_photo_wakil')">
                                    <label class="custom-file-label" for="customFile">Pilih File</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="before_picture_wakil" class="col-form-label col-sm-2 pt-0">Foto Sebelumnya</label>
                            <div class="col-sm-4">
                                <img src="{{ asset('uploads/'.$wakil->picture) }}" alt="" class="img-thumbnail" width="200">
                            </div>
                            <label for="preview_picture_wakil" class="col-form-label col-sm-2 pt-0">Foto Baru</label>
                            <div class="col-sm-4">
                                <img src="" alt="" id="preview_photo_wakil" class="img-thumbnail" width="200">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-fieldset mt-3">
                        <legend>Visi & Misi</legend>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="visi">Visi</label>
                                <textarea class="form-control" name="visi" id="visi" cols="10" rows="10">{{ $candidate->visi }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="misi">Misi</label>
                                <textarea class="form-control" name="misi" id="misi" cols="10" rows="10">{{ $candidate->misi }}</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <button class="btn btn-primary mt-3" type="submit" id="btn-add">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script src="{{ asset('lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('lib/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ asset('lib/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>
@endpush

@push('js-script')
<script>
    $(document).ready(function () {
        $('.select2').select2();

        $("#form_update").on("submit", function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            updateData(formData);
        });
    });

    function updateData(formData) {
        $.ajax({
            url: "{{ route('admin.candidate.update') }}",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend() {
                $("input").attr('disabled', 'disabled');
                $("select").attr('disabled', 'disabled');
                $("textarea").attr('disabled', 'disabled');
                $("#btn-add").attr('disabled', 'disabled');
                $("#btn-add").html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
                `);
            },
            complete() {
                $("input").removeAttr('disabled', 'disabled');
                $("select").removeAttr('disabled', 'disabled');
                $("textarea").removeAttr('disabled', 'disabled');
                $("#btn-add").removeAttr('disabled', 'disabled');
                $("#btn-add").html(`Tambah`);
            },
            success: function(result) {
                $("#alerts").html(result);

                setTimeout(function () {
                    $("#alerts").html('');
                    window.location="{{ route('admin.candidate.index') }}";
                }, 3000);
            },
            error: function() {
            }
        })
    }

    function showPreview(gambar,idpreview){

        var gb = gambar.files;

        for (var i = 0; i < gb.length; i++){

            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview=document.getElementById(idpreview);
            var reader = new FileReader();

            if (gbPreview.type.match(imageType)) {

                preview.file = gbPreview;
                reader.onload = (function(element) {
                    return function(e) {
                        element.src = e.target.result;
                    };
                })(preview);

                reader.readAsDataURL(gbPreview);
            }else{

                alert("Type file tidak sesuai. Khusus image.");
            }

        }
    }
</script>
@endpush
