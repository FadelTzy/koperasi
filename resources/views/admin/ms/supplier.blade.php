@extends('base')
@section('css')
    <link href="{{ asset('v/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('v/assets/plugins/notifications/css/lobibox.min.css') }}" />
@endsection
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Master Data</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Supplier</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="tambahdata" class=" form-horizontal form-bordered">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Nama</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="nama" placeholder="Input Nama" class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Alamat</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="alamat" placeholder="Input Alamat"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Bank</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="bank" placeholder="Input Bank" class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Nama Rekening</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="nama_rek" placeholder="Input Nama Rekening"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Nomor Rekening</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="nomor_rek" placeholder="Input Nomor Rekening"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">NPWP</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="npwp" placeholder="Input NPWP" class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Bank Pusat</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="bank_pusat" placeholder="Input Bank Pusat"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Kode Bank Pusat</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="kode_bank_pusat" placeholder="Input Kode Bank Pusat"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Swift</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="swift" placeholder="Input Swift" class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Tipe SUP</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="tipe_sup" placeholder="Input Tipe SUP"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Nomor Telpon</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="telpon" placeholder="Input Nomor Telpon"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Kode Negara</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="kode_negara" placeholder="Input Kode Negara"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Negara</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" name="negara" placeholder="Input Negara"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Kode Pos</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" placeholder="Input Kode Pos" name="kode_pos"
                                            class=" form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Provinsi</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" placeholder="Input Provinsi" name="provinsi"
                                            class=" form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Kota</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" placeholder="Input Kota" name="kota" class=" form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Email</label>
                                    <div class="mb-2 input-group">
                                        <input type="email" placeholder="Input Email" name="email" class=" form-control" />
                                    </div><!-- input-group -->
                                </div>

                            </div>


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
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Nama</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="namau" name="nama" placeholder="Input Nama"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Alamat</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="alamatu" name="alamat" placeholder="Input Alamat"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Bank</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="banku" name="bank" placeholder="Input Bank"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Nama Rekening</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="nama_reku" name="nama_rek" placeholder="Input Nama Rekening"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Nomor Rekening</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="nomor_reku" name="nomor_rek"
                                            placeholder="Input Nomor Rekening" class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">NPWP</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="npwpu" name="npwp" placeholder="Input NPWP"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Bank Pusat</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="bank_pusatu" name="bank_pusat" placeholder="Input Bank Pusat"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Kode Bank Pusat</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="kode_bank_pusatu" name="kode_bank_pusat"
                                            placeholder="Input Kode Bank Pusat" class="form-control" />
                                    </div><!-- input-group -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Swift</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="swiftu" name="swift" placeholder="Input Swift"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Tipe SUP</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="tipe_supu" name="tipe_sup" placeholder="Input Tipe SUP"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Nomor Telpon</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="telponu" name="telpon" placeholder="Input Nomor Telpon"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Kode Negara</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="kode_negarau" name="kode_negara"
                                            placeholder="Input Kode Negara" class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Negara</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="negarau" name="negara" placeholder="Input Negara"
                                            class="form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Kode Pos</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="kode_posu" placeholder="Input Kode Pos" name="kode_pos"
                                            class=" form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Provinsi</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="provinsiu" placeholder="Input Provinsi" name="provinsi"
                                            class=" form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Kota</label>
                                    <div class="mb-2 input-group">
                                        <input type="text" id="kotau" placeholder="Input Kota" name="kota"
                                            class=" form-control" />
                                    </div><!-- input-group -->
                                    <label class="form-label">Email</label>
                                    <div class="mb-2 input-group">
                                        <input type="email" id="emailu" placeholder="Input Email" name="email"
                                            class=" form-control" />
                                    </div><!-- input-group -->
                                </div>

                            </div>
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
            <h6 class="mb-0 text-uppercase">Manajemen Data Supplier </h6>
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
                                <th>Kota</th>
                                <th>Alamat</th>
                                <th>Bank</th>
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
        function bytesToSize(bytes) {
            var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (bytes == 0) return '0 Byte';
            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        }

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
                    {
                        orderable: false,

                        targets: 5,
                        width: "20%",

                    },

                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('supplier.index') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'nama',
                        data: 'nama'
                    },
                    {
                        nama: 'kota',
                        data: 'kota'
                    },
                    {
                        nama: 'alamat',
                        data: 'alamat'
                    },
                    {
                        nama: 'bank',
                        data: 'bank'
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
                    url: url + '/admin/supplier/' + id,
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
                url: '{{ route('supplier.store') }}',
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
                url: '{{ url('admin/supplier/edit') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    $('#myModalu').modal('hide');
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
            $("#namau").val(id.nama);
            $("#banku").val(id.bank);
            $("#alamatu").val(id.alamat);
            $("#nama_reku").val(id.nama_rek);
            $("#nomor_reku").val(id.no_rek);
            $("#npwpu").val(id.npwp);
            $("#bank_pusatu").val(id.bank_pusat);
            $("#kode_bank_pusatu").val(id.kode_bank_pusat);
            $("#swiftu").val(id.swift);
            $("#tipe_supu").val(id.tipe_sup);
            $("#telponu").val(id.telp);
            $("#kode_negarau").val(id.kode_negara);
            $("#negarau").val(id.negara);
            $("#kode_posu").val(id.kode_pos);
            $("#kotau").val(id.kota);
            $("#emailu").val(id.email);
            $("#provinsiu").val(id.provinsi);



        }
    </script>
@endpush
