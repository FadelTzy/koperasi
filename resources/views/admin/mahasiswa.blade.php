@extends('base')
@section('css')
    <link href="{{ asset('v/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('v/assets/plugins/notifications/css/lobibox.min.css') }}" />
@endsection
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Data User</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Mahasiswa</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="tambahdata" class=" form-horizontal form-bordered">
                            @csrf
                            <label class="form-label">Nama</label>
                            <div class="input-group">
                                <input type="text" name="nama" placeholder="Input Nama" class="form-control" />

                            </div><!-- input-group -->

                            <br>
                            <label class="form-label">NIM</label>
                            <div class="input-group">
                                <input type="text" name="nim" placeholder="Input NIM" class="form-control" />

                            </div><!-- input-group -->
                            <br>
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <input type="email" name="email" placeholder="Input Email" class="form-control" />

                            </div><!-- input-group -->
                            <br>
                            <label class="form-label">Angkatan</label>
                            <div class="input-group">
                                <input type="text" name="angkatan" placeholder="Input Angkatan" class="form-control" />

                            </div><!-- input-group -->
                            <br>
                            <label class="form-label">No </label>
                            <div class="input-group">
                                <input type="text" name="no" placeholder="Input Nomor" class="form-control" />
                            </div><!-- input-group -->
                            <br>
                            <label class="form-label">Program Studi </label>
                            <div class="input-group">
                                <select name="pg" class="form-control" id="">
                                    <option disabled selected>Pilih Program Studi</option>
                                    <option value="1">Pendidikan Teknik Informatika & Komputer</option>
                                    <option value="2">Teknik Komputer</option>
                                </select>
                            </div><!-- input-group -->
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="submitbtn" type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleLargeModalu" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="editdata" class=" form-horizontal form-bordered">
                            @csrf
                            <input type="hidden" name="id" id="idu">
                            <label class="form-label">Nama</label>
                            <div class="input-group">
                                <input type="text" id="namau" name="nama" placeholder="Input Nama" class="form-control" />

                            </div><!-- input-group -->

                            <br>
                            <label class="form-label">NIM</label>
                            <div class="input-group">
                                <input type="text" id="nimu" name="nim" placeholder="Input NIM" class="form-control" />

                            </div><!-- input-group -->
                            <br>
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <input type="email" id="emailu" name="email" placeholder="Input Email"
                                    class="form-control" />

                            </div><!-- input-group -->
                            <br>
                            <label class="form-label">Angkatan</label>
                            <div class="input-group">
                                <input type="text" id="angkatanu" name="angkatan" placeholder="Input Angkatan"
                                    class="form-control" />

                            </div><!-- input-group -->
                            <br>
                            <label class="form-label">No </label>
                            <div class="input-group">
                                <input type="text" id="nou" name="no" placeholder="Input Nomor" class="form-control" />
                            </div><!-- input-group -->
                            <br>
                            <label class="form-label">Program Studi </label>
                            <div class="input-group">
                                <select id="pgu" name="pg" class="form-control" id="">
                                    <option disabled selected>Pilih Program Studi</option>
                                    <option value="1">Pendidikan Teknik Informatika & Komputer</option>
                                    <option value="2">Teknik Komputer</option>
                                </select>
                            </div><!-- input-group -->
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="submitbtnu" type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="vertical-align: bottom" class="d-flex justify-content-between">
            <h6 class="mb-0 text-uppercase">Manajemen Data Mahasiswa </h6>
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal"
                class="btn btn-sm btn-success">Tambah Data <i class="bx bx-folder-plus"></i></button>
        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-bordered" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>No</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>


                    </table>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection
@push('js')
    <!--notification js -->
    <script src="{{ asset('v/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('v/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('v/assets/plugins/notifications/js/notification-custom-script.js') }}"></script>
    <script src="{{ asset('v/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('v/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ">
    </script>
    <script>
        jQuery(document).ready(function() {

            tabel = $("#example").DataTable({
                columnDefs: [{
                        targets: 0,
                        width: "1%",
                    },
                    {
                        targets: 1,
                        width: "30%",

                    },
                    {
                        orderable: false,

                        targets: 2,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 3,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 4,
                        width: "20%",

                    },

                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('datamahasiswa.index') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'name',
                        data: 'name'
                    },
                    {
                        nama: 'no_identitas',
                        data: 'no_identitas'
                    },

                    {
                        nama: 'no',
                        data: 'no'
                    },
                    {
                        name: 'aksi',
                        data: 'aksi',
                    }
                ],

            });



        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = window.location.origin;

        function staffdel(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/user/mahasiswa/' + id,
                    type: "delete",
                    success: function(e) {
                        $.LoadingOverlay("hide");
                        if (e == 'success') {
                            round_success_noti('Berhasil menghapus data');

                            tabel.ajax.reload();

                        } else {

                            round_error_noti('Gagal menghapus data');
                        }

                    }
                })

            }
        }
        $("#submitbtn").on('click', function() {
            $("#tambahdata").trigger('submit');
        });

        $("#tambahdata").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('datamahasiswa.store') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");
                    $("#tambahdata").trigger('reset');
                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;
                        var result = Object.keys(data).map((key) => [data[key]]);
                        elem =
                            '<div><ul>';
                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        $("#listnotif").html(elem);
                        $("#listnotif").addClass('mt-2');
                        console.log(elem)
                        round_error_noti(elem);
                    } else {
                        $('#exampleLargeModal').modal('hide');
                        round_success_noti();

                        tabel.ajax.reload();

                    }
                }
            })


        })
        $("#submitbtnu").on('click', function() {
            $("#editdata").trigger('submit');
        });

        $("#editdata").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('datamahasiswa.update') }}',
                data: data,
                type: "POST",

                success: function(id) {
                    $('#exampleLargeModalu').modal('hide');
                    $.LoadingOverlay("hide");
                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;
                        var result = Object.keys(data).map((key) => [data[key]]);
                        elem =
                            '<div ><u>';
                        elem +=
                            '   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button><ul>';
                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        $("#listnotif").html(elem);
                        $("#listnotif").addClass('mt-2');
                        round_error_noti(elem);

                    } else {
                        round_success_noti();

                        tabel.ajax.reload();

                    }
                }
            })


        })

        function staffupd(id) {
            $('#exampleLargeModalu').modal('show');

            $("#idu").val(id.id);
            $("#namau").val(id.name);
            $("#nimu").val(id.no_identitas);
            $('#pgu option[value=' + id.ps + ']').attr('selected', 'selected');

            $("#emailu").val(id.email);
            $("#nou").val(id.no);
            $("#angkatanu").val(id.angkatan);
        }
    </script>
@endpush
