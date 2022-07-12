@extends('base')
@section('css')
    <link rel="stylesheet" href="{{ asset('v/assets/plugins/notifications/css/lobibox.min.css') }}" />
    <link href="{{ asset('v/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('v/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tambah Data Monitoring Perkuliahan</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div style="vertical-align: bottom" class="d-flex justify-content-between">
            <div>
                <h6 class="mb-0 text-uppercase"> Form Pengisian Data Monitoring </h6>
            </div>
            <div>
                <a type="button" href="{{ route('monitoring.index') }}" class="btn btn-sm btn-primary"
                    class="btn btn-sm btn-success"><i class="bx bx-caret-left"></i> Kembali </a>
            </div>
        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <form id="tambahdata" class="row g-3">
                    @csrf
                    <h6>Informasi Perkuliahan</h6>

                    <div class="col-md-12">
                        <label for="inputFirstName" class="form-label">Program Studi</label>
                        <select name="prodi" class="form-control" id="">
                            <option @if (Auth::user()->ps == 1) "selected" @endif value="1">Pendidikan Teknik
                                Informatika & Komputer</option>
                            <option @if (Auth::user()->ps == 2) "selected" @endif value="2"> Teknik
                                Komputer</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nomor" class="form-label">Tahun Ajaran</label>
                        @php $ped = DB::table('periodes')->get() @endphp
                        <select name="periode" class="form-control single-select" id="">
                            @foreach ($ped as $item)
                                <option @if ($item->status == 1) 'selected' @endif value="{{ $item->id }}">
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState2" class="form-label">Kelas</label>
                        @php $kel = DB::table('kelas')->get() @endphp
                        <select name="kelas" class="form-control single-select">
                            @foreach ($kel as $item)
                                <option @if ($item->id_keti == Auth::user()->no_identitas) 'selected' @endif value="{{ $item->id }}">
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Mata Kuliah</label>

                        <select name="matkul" id="matkul" class="form-control single-select" id="">
                            <option selected disabled>Pilih Mata Kuliah</option>
                            @foreach ($matkul as $item)
                                <option value="{{ $item->id }},{{ $item->namadosen->id }}">
                                    {{ $item->kode_matkul }} {{ $item->nama_matkul }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Dosen Pengampu</label>
                        <select id="dosen" name="dosen" class="form-control single-select" id="">
                            <option selected disabled>Pilih Dosen</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <h6>Lokasi & Jadwal Perkuliahan</h6>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Status Perkuliahan</label>
                        <br>
                        <label class="radio-inline">
                            <input type="radio" id="luring" value="1" name="sp" checked> Luring
                        </label>
                        <label class="radio-inline">
                            <input id="daring" type="radio" value="2" name="sp"> Daring
                        </label>

                    </div>
                    <div id="colruangan" class="col-md-6">
                        <label for="inputState" class="form-label">Ruangan</label>
                        @php $ruang = DB::table('ruangans')->get() @endphp
                        <select name="ruang" class="form-control single-select" id="">
                            <option selected disabled>Pilih Ruangan</option>
                            @foreach ($ruang as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="">
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Jam</label>
                        <br>
                        <label class="radio-inline">
                            <input type="time" id="jam_awal" class="form-control" name="jam_awal"> Jam Masuk
                        </label>
                        <label class="radio-inline">
                            <input id="jam_akhir" type="time" class="form-control" name="jam_akhir">Jam Pulang
                        </label>
                    </div>
                    <hr>
                    <h6>Informasi Tambahan</h6>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Pertemuan Ke</label>
                        <input type="text" class="form-control" name="pertemuan">
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Jumlah Mahasiswa Hadir</label>
                        <input type="text" class="form-control" name="jumlah">
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="" cols="30" rows="5"></textarea>
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Foto Perkuliahan</label>
                        <input type="file" class="form-control" name="file">

                    </div>
                    <button id="submitbtn" type="button" class="btn btn-sm btn-primary">Simpan</button>
                </form>
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

    <script src="{{ asset('v/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ">
    </script>
    <script>
        jQuery(document).ready(function() {
            $("#matkul").on('change', function(param) {
                val = $(this).val();
                var matkularr = val.split(',');

                $("#dosen").select2().val(matkularr[1]).trigger("change");

            })
            $("input[name='sp']").on('click', function() {
                if ($("#daring").is(':checked')) {
                    $("#colruangan").addClass('d-none');
                }
                if ($("#luring").is(':checked')) {
                    $("#colruangan").removeClass('d-none');
                }
            })


        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = window.location.origin;


        $("#submitbtn").on('click', function() {
            $("#tambahdata").trigger('submit');
        });

        $("#tambahdata").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('monitoring.store') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");
                    // $("#tambahdata").trigger('reset');
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
                url: '{{ url('matkul/edit') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
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
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        function staffupd(id) {
            $('#exampleLargeModalu').modal('show');

            $("#idu").val(id.id);
            $("#kodeu").val(id.kode_matkul);
            $("#matkulu").val(id.nama_matkul);

            $("#sksu").val(id.sks);
            var jam = id.jam.split(' - ');
            $("#jam_awalu").val(jam[0]);
            $("#jam_akhiru").val(jam[1]);

            $('#dosenu option[value=' + id.dosen + ']').attr('selected', 'selected');
            $('#mitrau option[value=' + id.mitra + ']').attr('selected', 'selected');
            $('#hariu option[value=' + id.hari + ']').attr('selected', 'selected');

            // Demo Button Events

        }
    </script>
@endpush
