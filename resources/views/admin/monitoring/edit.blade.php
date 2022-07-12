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
            <div class="breadcrumb-title pe-3">Edit Data Monitoring Perkuliahan</div>
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
                    <input type="hidden" value="{{ $dm->id }}" name="id">
                    <h6>Informasi Perkuliahan</h6>

                    <div class="col-md-12">
                        <label for="inputFirstName" class="form-label">Program Studi</label>
                        <select name="prodi" class="form-control" id="">
                            <option @if ($dm->prodi == 1) "selected" @endif value="1">Pendidikan Teknik
                                Informatika & Komputer</option>
                            <option @if ($dm->prodi == 2) "selected" @endif value="2"> Teknik
                                Komputer</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nomor" class="form-label">Tahun Ajaran</label>
                        @php $ped = DB::table('periodes')->get() @endphp

                        <select name="periode" class="form-control single-select" id="">
                            @foreach ($ped as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState2" class="form-label">Kelas</label>
                        @php $kel = DB::table('kelas')->get() @endphp
                        <select name="kelas" class="form-control single-select">
                            @foreach ($kel as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Mata Kuliah</label>

                        <select name="matkul" id="matkul" class="form-control single-select" id="">
                            <option selected disabled>Pilih Mata Kuliah</option>
                            @foreach ($matkul as $item)
                                <option value="{{ $item->id }}">
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
                            <input type="radio" id="luring" @if ($dm->status_belajar == 1) 'checked' @endif value="1"
                                name="sp"> Luring
                        </label>
                        <label class="radio-inline">
                            <input id="daring" type="radio" value="2" @if ($dm->status_belajar == 2) 'checked' @endif
                                name="sp"> Daring
                        </label>

                    </div>
                    <div id="colruangan" class="col-md-6">
                        <label for="inputState" class="form-label">Ruangan</label>
                        @php $ruang = DB::table('ruangans')->get() @endphp
                        <select name="ruang" class="form-control single-select" id="">
                            <option selected disabled>Pilih Ruangan </option>
                            @foreach ($ruang as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $dm->tanggal }}" class="form-control" id="">
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Jam</label>
                        <br>
                        <label class="radio-inline">
                            <input type="time" id="jam_awal" class="form-control" value="{{ $dm->jam_awal }}"
                                name="jam_awal"> Jam Masuk
                        </label>
                        <label class="radio-inline">
                            <input id="jam_akhir" type="time" class="form-control" value="{{ $dm->jam_akhir }}"
                                name="jam_akhir">Jam Pulang
                        </label>
                    </div>
                    <hr>
                    <h6>Informasi Tambahan</h6>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Pertemuan Ke</label>
                        <input type="text" class="form-control" value="{{ $dm->pertemuan }}" name="pertemuan">
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Jumlah Mahasiswa Hadir</label>
                        <input type="text" class="form-control" value="{{ $dm->jml_hadir }}" name="jumlah">
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="" cols="30" rows="5">{{ $dm->keterangan }}</textarea>
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Foto Perkuliahan</label>
                        <input type="file" class="form-control" name="file">
                        @if ($dm->bukti != null)
                            <span class="text-success">File Tersedia <a
                                    href="{{ asset('gambar/bukti') }}/{{ $dm->bukti }}" target="_blank"
                                    class="btn btn-success btn-sm">Cek</a></span>
                        @endif
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
            $("[name=ruang]").val("{{ $dm->ruang }}").trigger('change');
            $("[name=dosen]").val("{{ $dm->id_dosen }}").trigger('change');
            $("[name=matkul]").val("{{ $dm->matkul }}").trigger('change');
            $("[name=periode]").val("{{ $dm->id_periode }}").trigger('change');
            $("[name=kelas]").val("{{ $dm->kelas }}").trigger('change');

            if ('{{ $dm->status_belajar }}' == 2) {
                $("#daring").prop("checked", true);
                $("#colruangan").addClass('d-none');

            } else {
                $("#luring").prop("checked", true);
                $("#colruangan").removeClass('d-none');


            }

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
                url: '{{ route('monitoring.update') }}',
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
    </script>
@endpush
