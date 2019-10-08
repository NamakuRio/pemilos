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
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0">Tambah Kandidat</h4>
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
            <div data-label="Tambah Kandidat" class="df-example demo-table">
                <form method="post" action="{{ route('admin.candidate.store') }}" enctype="multipart/form-data" id="form_add">
                    @csrf
                    <fieldset class="form-fieldset mt-3">
                        <legend>Ketua</legend>
                        <div class="form-group row">
                            <label for="name_ketua" class="col-sm-2 col-form-label">Nama Ketua</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name_ketua" name="name_ketua" placeholder="Nama Ketua">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class_ketua" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="class_ketua" name="class_ketua">
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="majors_ketua" class="col-form-label col-sm-2 pt-0">Jurusan</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="majors_ketua" name="majors_ketua">
                                    <option value="AKL">AKL</option>
                                    <option value="OTKP">OTKP</option>
                                    <option value="BDP">BDP</option>
                                    <option value="UPW">UPW</option>
                                    <option value="RPL">RPL</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender_ketua" class="col-form-label col-sm-2 pt-0">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="gender_ketua" name="gender_ketua">
                                    <option value="L">Laki - laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="picture_ketua" class="col-form-label col-sm-2 pt-0">Foto</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="picture_ketua" name="picture_ketua">
                                    <label class="custom-file-label" for="customFile">Pilih File</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-fieldset mt-3">
                        <legend>Wakil</legend>
                        <div class="form-group row">
                            <label for="name_wakil" class="col-sm-2 col-form-label">Nama Wakil</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name_wakil" name="name_wakil" placeholder="Nama Wakil">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class_wakil" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="class_wakil" name="class_wakil">
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="majors_wakil" class="col-form-label col-sm-2 pt-0">Jurusan</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="majors_wakil" name="majors_wakil">
                                    <option value="AKL">AKL</option>
                                    <option value="OTKP">OTKP</option>
                                    <option value="BDP">BDP</option>
                                    <option value="UPW">UPW</option>
                                    <option value="RPL">RPL</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender_wakil" class="col-form-label col-sm-2 pt-0">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="custom-select select2" id="gender_wakil" name="gender_wakil">
                                    <option value="L">Laki - laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="picture_wakil" class="col-form-label col-sm-2 pt-0">Foto</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="picture_wakil" name="picture_wakil">
                                    <label class="custom-file-label" for="customFile">Pilih File</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-fieldset mt-3">
                        <legend>Visi & Misi</legend>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="visi">Visi</label>
                                <textarea class="form-control" name="visi" id="visi" cols="10" rows="10"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="misi">Misi</label>
                                <textarea class="form-control" name="misi" id="misi" cols="10" rows="10"></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <button class="btn btn-primary mt-3" type="submit" id="btn-add">Tambah</button>
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

        $("#form_add").on("submit", function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            addData(formData);
        });
    });

    function addData(formData) {
        $.ajax({
            url: "{{ route('admin.candidate.store') }}",
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
</script>
@endpush
