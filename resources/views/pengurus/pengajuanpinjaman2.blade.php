@extends('base')
@section('css')
    <link href="{{ asset('v/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('v/assets/plugins/notifications/css/lobibox.min.css') }}" />
@endsection
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Data Pinjaman</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pinjaman</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div style="vertical-align: bottom" class="d-flex justify-content-between">
            <h6 class="mb-0 text-uppercase">Laporan Data Pinjaman </h6>
            <a type="button" target="_blank" href="{{ route('cp.index') }}" class="btn btn-sm btn-primary">Print</a>

        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-bordered" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Pinjaman</th>
                                <th>Peminjam</th>

                                <th>Tgl Pengajuan</th>
                                <th>Nama Pinjaman</th>
                                <th>Jumlah </th>
                                <th>Angsuran</th>
                                <th>Bunga </th>
                                <th>Biaya Angsuran </th>
                                <th>Status Pengajuan</th>
                                <th>Status Pinjaman</th>

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
                        width: "10%",

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
                    {
                        orderable: false,

                        targets: 6,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 7,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 8,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 9,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 10,
                        width: "20%",

                    },


                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/admin/laporan-pinjaman') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'kode_pinjam',
                        data: 'kode_pinjam'
                    },
                    {
                        nama: 'np',
                        data: 'np'
                    },
                    {
                        nama: 'tanggal',
                        data: 'tanggal'
                    },


                    {
                        nama: 'nama_pinjam',
                        data: 'nama_pinjam'
                    },
                    {
                        nama: 'jumlah_pinjam',
                        data: function(param) {
                            return 'Rp. ' + param['jumlah_pinjam'];
                        }
                    },
                    {
                        name: 'angsuran',
                        data: 'angsuran',
                    },
                    {
                        name: 'bungaa',
                        data: 'bungaa',
                    },
                    {
                        name: 'total',
                        data: 'total',
                    },

                    {
                        nama: 'status_pe',
                        data: 'status_pe'
                    },
                    {
                        name: 'status_pi',
                        data: 'status_pi',
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
        $("#jenispinjaman").on('change', function(e) {
            var optVal = $("#jenispinjaman option:selected");
            $("#maksimal").val(optVal[0].dataset.jumlah)
            $("#bunga").val(optVal[0].dataset.bunga)
            $("#tenor").val(optVal[0].dataset.angsur)
            $("#nama_pinjam").val(optVal[0].dataset.nama)
        })

        function showMe(e) {
            let id = e.attributes[0].value;
            var optVal = $("#jenispinjaman option:selected");
            var angsur = parseInt(e.value) / parseInt(optVal[0].dataset.angsur);
            var bunga = (parseInt(e.value) * (parseInt(optVal[0].dataset.bunga) / 100)) / 12;

            $("#angsuranpokok").val(angsur.toFixed(3));
            $("#angsuranbunga").val(bunga.toFixed(3));

            console.log(angsur);
            if (parseInt(optVal[0].dataset.jumlah) < e.value) {
                alert("Melebihi Batas Peminjaman ");
                $("#pinjamana").val(optVal[0].dataset.jumlah);
            }
            if (e.value == 0) {
                $("#pinjamana").val('');
            }
        }

        function showMe2(e) {
            let id = e.attributes[0].value;
            var optVal = $("#maksimalu").val();
            var angsur = parseInt(e.value) / parseInt($("#angsuru").val());
            var bunga = (parseInt(e.value) * (parseInt($("#bungau").val()) / 100)) / 12;

            $("#angsuranpokoku").val(angsur.toFixed(3));
            $("#angsuranbungau").val(bunga.toFixed(3));

        }

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
                    url: url + '/admin/data-pinjaman/' + id,
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

        function staffterima(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/admin/data-pengajuan/terima/' + id,
                    type: "post",
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
                url: '{{ route('pa.store') }}',
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
                url: '{{ route('pa.update') }}',
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
            $('#editdata').trigger("reset");
            $("#idu").val(id.id);

            $("#angsuru").val(id.lama_angsuran);
            $("#bungau").val(id.bunga);
            $("#angsuranpokoku").val(id.biaya_angsuran_pokok);
            $("#angsuranbungau").val(id.biaya_angsuran_pokok);

            $("#maksimalu").val(id.jumlah_pinjam);
            $("#namau").val(id.nama_pinjam);
            $("#kodeu").val(id.kode_pinjam);

        }
    </script>
@endpush
