@extends('pdf.layout')

@section('content')
    <div style="text-align: center">


        <p style='margin:0cm;margin-bottom:.0001pt;margin-top:2pt;font-size:20px;font-family:"serif";'>
            <strong>DATA LAPORAN PINJAMAN ANGGOTA</strong>
        </p>
    </div>
    <br>
    <br>
    <p style='margin:0cm;margin-bottom:.0001pt;margin-top:2pt;font-size:16px;font-family:"serif";'>
        <strong>Nama : {{ $user->name }} <br> Kode Anggota : {{ $user->kode }}</strong>
    </p>
    <br>
    <br>
    <table class="p">
        <tbody>
            <tr class="">

                <th class="text-center" style="width:5%; text-align:center">No</th>
                <th class="text-center" style="width:10%; text-align:center">Kode Pinjaman</th>
                <th class="text-center" style="width:10%; text-align:center">Tgl Pengajuan</th>
                <th class="text-center" style="width:10%; text-align:center">Nama Pinjaman</th>
                <th class="text-center" style="width:10%; text-align:center">Jumlah </th>
                <th class="text-center" style="width:10%; text-align:center">Angsuran</th>
                <th class="text-center" style="width:10%; text-align:center">Bunga </th>
                <th class="text-center" style="width:10%; text-align:center">Biaya Angsuran </th>
                <th class="text-center" style="width:10%; text-align:center">Status Pengajuan</th>
                <th class="text-center" style="width:10%; text-align:center">Status Pinjaman</th>


            </tr>
            @php
                $no = 1;
                $total = [];
            @endphp
            @foreach ($datapinjam->getData()->data as $s)
                <tr>
                    <td style=" text-align:center">{{ $no++ }}</td>
                    <td style=" text-align:center">{{ $s->kode_pinjam }}</td>
                    <td style=" text-align:center">{{ $s->tanggal }}</td>
                    <td style=" text-align:center">{{ $s->nama_pinjam }}</td>
                    <td style=" text-align:center">Rp. {{ $s->jumlah_pinjam }}</td>
                    <td style=" text-align:center">{{ $s->angsuran }}</td>
                    <td style=" text-align:center">{{ $s->bungaa }}</td>
                    <td style=" text-align:center">{{ $s->total }}</td>
                    <td style=" text-align:center">{{ $s->status_pe }}</td>
                    <td style=" text-align:center">{{ $s->status_pi }}</td>


                </tr>
            @endforeach

        </tbody>
    </table>
    <br>
    <p>Tanggal Cetak {{ $date }}</p>
@endsection
