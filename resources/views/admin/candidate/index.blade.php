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
                        <li class="breadcrumb-item active" aria-current="page">List</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0">List Kandidat</h4>
            </div>
            <a href="{{ route('admin.candidate.create') }}" class="btn btn-sm btn-outline-primary">Tambah Kandidat</a>
        </div>
    </div><!-- container -->
</div><!-- content -->
<div class="content">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="alerts" id="alerts">

        </div>
        <div class="card tx-white">
            <div data-label="List Kandidat" class="df-example demo-table">
                <table id="candidate-list" class="table">
                    <thead>
                        <tr>
                            <th class="wd-20p">#</th>
                            <th class="wd-20p">Ketua</th>
                            <th class="wd-25p">Wakil</th>
                            <th class="wd-20p">Visi</th>
                            <th class="wd-15p">Misi</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                        </tr>
                    </tbody> --}}
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
                <form action="{{ route('admin.candidate.destroy') }}" method="post" id="form_delete">
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
    <div class="modal fade" id="ketua_modal" tabindex="-1" role="dialog" aria-labelledby="ketua_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-14">
                <div class="text-center" id="sr-load-ketua" style="position:absolute;width:100%;height:100%;background:#00000033;z-index:10">
                    <div class="spinner-border" role="status" style="position:absolute;top:160px;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel2">Ketua</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="view-name-ketua" class="d-block">Nama</label>
                        <input type="text" class="form-control" id="view-name-ketua" placeholder="Nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="view-kelas-ketua" class="d-block">Kelas</label>
                        <input type="text" class="form-control" id="view-kelas-ketua" placeholder="Kelas" readonly>
                    </div>
                    <div class="form-group">
                        <label for="view-jurusan-ketua" class="d-block">Jurusan</label>
                        <input type="text" class="form-control" id="view-jurusan-ketua" placeholder="Jurusan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="view-jk-ketua" class="d-block">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="view-jk-ketua" placeholder="Jenis Kelamin" readonly>
                    </div>
                    <div class="form-group">
                        <label for="view-jk-ketua" class="d-block">Foto</label>
                        <div id="view-picture-ketua"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-success tx-13" data-dismiss="modal" class="btn-close">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="wakil_modal" tabindex="-1" role="dialog" aria-labelledby="wakil_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-14">
                <div class="text-center" id="sr-load-wakil" style="position:absolute;width:100%;height:100%;background:#00000033;z-index:10">
                    <div class="spinner-border" role="status" style="position:absolute;top:160px;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel2">Wakil</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="view-name-wakil" class="d-block">Nama</label>
                        <input type="text" class="form-control" id="view-name-wakil" placeholder="Nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="view-kelas-wakil" class="d-block">Kelas</label>
                        <input type="text" class="form-control" id="view-kelas-wakil" placeholder="Kelas" readonly>
                    </div>
                    <div class="form-group">
                        <label for="view-jurusan-wakil" class="d-block">Jurusan</label>
                        <input type="text" class="form-control" id="view-jurusan-wakil" placeholder="Jurusan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="view-jk-wakil" class="d-block">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="view-jk-wakil" placeholder="Jenis Kelamin" readonly>
                    </div>
                    <div class="form-group">
                        <label for="view-jk-wakil" class="d-block">Foto</label>
                        <div id="view-picture-wakil"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-success tx-13" data-dismiss="modal" class="btn-close">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="visi_modal" tabindex="-1" role="dialog" aria-labelledby="visi_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-14">
                <div class="text-center" id="sr-load-visi" style="position:absolute;width:100%;height:100%;background:#00000033;z-index:10">
                    <div class="spinner-border" role="status" style="position:absolute;top:160px;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel2">Visi</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" name="visi" id="visi-view" cols="30" rows="10" readonly></textarea>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-success tx-13" data-dismiss="modal" class="btn-close">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="misi_modal" tabindex="-1" role="dialog" aria-labelledby="misi_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-14">
                <div class="text-center" id="sr-load-misi" style="position:absolute;width:100%;height:100%;background:#00000033;z-index:10">
                    <div class="spinner-border" role="status" style="position:absolute;top:160px;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel2">Misi</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" name="misi" id="misi-view" cols="30" rows="10" readonly></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success tx-13" data-dismiss="modal" class="btn-close">Tutup</button>
                </div>
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
    candidateList();

    $("#form_delete").on("submit", function(e) {
        e.preventDefault();
        deleteData();
    });
});

function candidateList() {
    $('#candidate-list').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: "{{ route('admin.get.candidate') }}",
        columns: [
            { data: 'id' },
            { data: 'ketua' },
            { data: 'wakil' },
            { data: 'visi' },
            { data: 'misi' },
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



function ketua_modal(object) {
    var id = $(object).data('id');

    $("#ketua_modal").modal('show');
    $.ajax({
        url: "{{ route('admin.get.candidate.ketua') }}",
        type: "POST",
        dataType: "json",
        data:{
            "id": id,
            "detail": "ketua",
            "_method": "POST",
            "_token": "{{ csrf_token() }}"
        },
        beforeSend() {
            $("#sr-load-ketua").fadeIn();
        },
        complete() {
            $("#sr-load-ketua").fadeOut();
        },
        success : function(result) {
            $("#view-name-ketua").val(result['data']['name']);
            $("#view-kelas-ketua").val(result['data']['class']);
            $("#view-jurusan-ketua").val(result['data']['majors']);
            $("#view-jk-ketua").val(result['data']['gender']);
            $("#view-picture-ketua").html(result['picture']);
        }
    });
}

function wakil_modal(object) {
    var id = $(object).data('id');

    $("#wakil_modal").modal('show');
    $.ajax({
        url: "{{ route('admin.get.candidate.wakil') }}",
        type: "POST",
        dataType: "json",
        data:{
            "id": id,
            "detail": "wakil",
            "_method": "POST",
            "_token": "{{ csrf_token() }}"
        },
        beforeSend() {
            $("#sr-load-wakil").fadeIn();
        },
        complete() {
            $("#sr-load-wakil").fadeOut();
        },
        success : function(result) {
            $("#view-name-wakil").val(result['data']['name']);
            $("#view-kelas-wakil").val(result['data']['class']);
            $("#view-jurusan-wakil").val(result['data']['majors']);
            $("#view-jk-wakil").val(result['data']['gender']);
            $("#view-picture-wakil").html(result['picture']);
        }
    });
}

function visi_modal(object) {
    var id = $(object).data('id');

    $("#visi_modal").modal('show');
    $.ajax({
        url: "{{ route('admin.get.candidate.visi') }}",
        type: "POST",
        dataType: "json",
        data:{
            "id": id,
            "detail": "visi",
            "_method": "POST",
            "_token": "{{ csrf_token() }}"
        },
        beforeSend() {
            $("#sr-load-visi").fadeIn();
        },
        complete() {
            $("#sr-load-visi").fadeOut();
        },
        success : function(result) {
            $("#visi-view").val(result['data']);
        }
    });
}

function misi_modal(object) {
    var id = $(object).data('id');

    $("#misi_modal").modal('show');
    $.ajax({
        url: "{{ route('admin.get.candidate.misi') }}",
        type: "POST",
        dataType: "json",
        data:{
            "id": id,
            "detail": "misi",
            "_method": "POST",
            "_token": "{{ csrf_token() }}"
        },
        beforeSend() {
            $("#sr-load-misi").fadeIn();
        },
        complete() {
            $("#sr-load-misi").fadeOut();
        },
        success : function(result) {
            $("#misi-view").val(result['data']);
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
        url: "{{ route('admin.candidate.destroy') }}",
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
            candidateList();
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
