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
                        <li class="breadcrumb-item active" aria-current="page">List</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0">List User</h4>
            </div>
            <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-outline-primary">Tambah User</a>
        </div>
    </div><!-- container -->
</div><!-- content -->
<div class="content">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="alerts" id="alerts">

        </div>
        <div class="card tx-white">
            <div data-label="List User" class="df-example demo-table">
                <table id="user-list" class="table">
                    <thead>
                        <tr>
                            <th class="wd-20p">#</th>
                            <th class="wd-20p">username</th>
                            <th class="wd-25p">Nama</th>
                            <th class="wd-20p">email</th>
                            <th class="wd-15p">Code</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modals')
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-14">
                <form action="{{ route('admin.user.destroy') }}" method="post" id="form_delete">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id-delete" name="id" value="" required>
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel2">Hapus Data</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mg-b-0">Anda yakin ingin menghapus data tersebut?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success tx-13" data-dismiss="modal" class="btn-close">Close</button>
                        <button type="submit" class="btn btn-outline-danger tx-13" id="btn-delete">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="code_modal" tabindex="-1" role="dialog" aria-labelledby="code_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-14">
                <form action="{{ route('admin.user.destroy') }}" method="post" id="form_get_code">
                    @csrf
                    <input type="hidden" id="id-code" name="id_code" value="" required>
                    <div class="text-center" id="sr-load-code" style="position:absolute;width:100%;height:100%;background:#00000033;z-index:10;display:none;">
                        <div class="spinner-border" role="status" style="position:absolute;top:160px;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel2">Mendapatkan Kode</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body-get-code">
                        <div class="form-group">
                            <label for="get-code-user" class="d-block">Password</label>
                            <input type="password" class="form-control" id="view-name-wakil" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" class="btn btn-secondary tx-13" data-dismiss="modal" class="btn-close">Tutup</button>
                        <button  type="submit" class="btn btn-outline-info tx-13" id="btn-get-code" class="btn-close">Get Code!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

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
    userList();

    $("#form_delete").on("submit", function(e) {
        e.preventDefault();
        deleteData();
    });
    $("#form_get_code").on("submit", function(e) {
        e.preventDefault();
        getCodeData();
    });
});

function userList() {
    $('#user-list').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: "{{ route('admin.get.user') }}",
        columns: [
            { data: 'id' },
            { data: 'username' },
            { data: 'name' },
            { data: 'email' },
            { data: 'code' },
            { data: 'action' },
        ],
        language: {
            searchPlaceholder: 'Cari...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        }
    });
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
}

function code_modal(object) {
    var id = $(object).data('id');

    $("#code_modal").modal('show');
    $("#modal-body-get-code").html(`
    <div class="form-group">
        <label for="get-code-user" class="d-block">Password</label>
        <input type="password" class="form-control" id="view-name-wakil" placeholder="Password" name="password">
    </div>
    `);
    $("#form_get_code")[0].reset();
    $("input[name='id_code']").val(id);
    $("#btn-get-code").fadeIn();
}

function getCodeData() {
    var formData = $("#form_get_code").serialize();

    $.ajax({
        url: "{{ route('admin.get.user.code') }}",
        type: "POST",
        dataType: "html",
        data:formData,
        beforeSend() {
            $("button").attr('disabled', 'disabled');
            $("#btn-get-code").attr('disabled', 'disabled');
            $("#btn-get-code").html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
            `);
        },
        complete() {
            $("button").removeAttr('disabled', 'disabled');
            $("#btn-get-code").removeAttr('disabled', 'disabled');
            $("#btn-get-code").html(`Get Code!`);
            $("#btn-get-code").hide();
        },
        success : function(result) {
            $("#modal-body-get-code").html(result);

            // setTimeout(function () {
            //     $("#modal-body-get-code").html(`
            //     <div class="form-group">
            //         <label for="get-code-user" class="d-block">Password</label>
            //         <input type="password" class="form-control" id="view-name-wakil" placeholder="Password" name="password">
            //     </div>
            //     `);
            // }, 3000);
        }
    });
}
function delete_modal(object) {
    var id = $(object).data('id');

    $("#delete_modal").modal('show');
    $("input[name='id']").val(id);
}

function deleteData() {
    var formData = $("#form_delete").serialize();

    $.ajax({
        url: "{{ route('admin.user.destroy') }}",
        type: "POST",
        dataType: "html",
        data:formData,
        beforeSend() {
            $("button").attr('disabled', 'disabled');
            $("#btn-delete").attr('disabled', 'disabled');
            $("#btn-delete").html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
            `);
        },
        complete() {
            $("button").attr('disabled', 'disabled');
            $("#btn-delete").removeAttr('disabled', 'disabled');
            $("#btn-delete").html(`Hapus`);
        },
        success : function(result) {
            userList();
            $("#alerts").html(result);
            $("#delete_modal").modal('hide');

            setTimeout(function () {
                $("#alerts").html('');
            }, 3000);
        }
    });
}

</script>
@endpush
