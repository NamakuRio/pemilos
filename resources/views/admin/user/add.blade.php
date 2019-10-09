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
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0">Tambah User</h4>
            </div>
            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
        </div>
    </div><!-- container -->
</div><!-- content -->
<div class="content">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="alerts" id="alerts">

        </div>
        <div class="card tx-black">
            <div data-label="Tambah User" class="df-example demo-table">
                <form method="post" action="{{ route('admin.user.store') }}" id="form_add">
                    @csrf
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>

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
            url: "{{ route('admin.user.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend() {
                $("input").attr('disabled', 'disabled');
                $("#btn-add").attr('disabled', 'disabled');
                $("#btn-add").html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
                `);
            },
            complete() {
                $("input").removeAttr('disabled', 'disabled');
                $("#btn-add").removeAttr('disabled', 'disabled');
                $("#btn-add").html(`Tambah`);
            },
            success: function(result) {
                $("#alerts").html(result);

                setTimeout(function () {
                    $("#alerts").html('');
                    window.location="{{ route('admin.user.index') }}";
                }, 3000);
            },
            error: function() {
            }
        })
    }

</script>
@endpush
