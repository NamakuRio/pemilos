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
