@extends('base')
@section('css')
@endsection
@section('content')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-success">Total Anggota Aktif</h5>
                            <div class="ms-auto">
                                <i class='bx bx-user fs-3 text-success'></i>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">{{ $datau ?? 0 }}</h4>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-danger">Simpanan Anggota</h5>
                            <div class="ms-auto">
                                <i class='bx bx-wallet-alt fs-3 text-danger'></i>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Rp. {{ $simpan ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-warning"> Pinjaman Anggota</h5>
                            <div class="ms-auto">
                                <i class='bx bx-wallet-alt fs-3 text-warning'></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Rp. {{ $pinjam ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Angsuran Anggota</h5>
                            <div class="ms-auto">
                                <i class='bx bx-wallet-alt fs-3 text-primary'></i>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Rp. {{ $angsur ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="{{ asset('icon.jpg') }}" alt="..." class="card-img">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title">Selamat Datang Di Sistem Informasi Simpan Pinjam Koperasi Ikhlas SMPN
                                    1
                                    Palangga</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                    Aspernatur delectus exercitationem nobis nam maxime rerum tempora vitae numquam enim
                                    molestiae hic, assumenda natus quos rem ducimus autem omnis similique voluptas?</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->hasRole('dosen'))
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Daftar Kelas & Mata Kuliah Monitoring</h5>
                        </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        @php $no = 1; @endphp
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Mata Kuliah</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datamoni as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>

                                        <td>{{ $item[0]->namakelas->nama }}</td>
                                        <td>{{ $item[0]->namamatkul->kode_matkul }} -
                                            {{ $item[0]->namamatkul->nama_matkul }}</td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif




    </div>
@endsection
@push('js')
@endpush
