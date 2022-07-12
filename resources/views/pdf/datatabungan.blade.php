@extends('pdf.layout')

@section('content')
    <div style="text-align: center">


        <p style='margin:0cm;margin-bottom:.0001pt;margin-top:2pt;font-size:20px;font-family:"serif";'>
            <strong>DATA LAPORAN TABUNGAN ANGGOTA</strong>
        </p>
    </div>
    <br>
    <br>
    <br>
    <table class="p">
        <tbody>
            <tr class="">

                <th class="text-center" style="width:5%; text-align:center">No</th>
                <th class="text-center" style="width:5%; text-align:center">Kode</th>
                <th class="text-center" style="width:5%; text-align:center">Nama</th>
                <th class="text-center" style="width:5%; text-align:center">Alamat</th>
                <th class="text-center" style="width:5%; text-align:center">Telepon</th>
                <th class="text-center" style="width:5%; text-align:center">Tanggal Masuk</th>
                <th class="text-center" style="width:5%; text-align:center">Status</th>
                <th class="text-center" style="width:5%; text-align:center">Total Simpanan</th>


            </tr>
            @php
                $no = 1;
                $total = [];
            @endphp
            @foreach ($data->getData()->data as $s)
                <tr>
                    <td style=" text-align:center">{{ $no++ }}</td>
                    <td style=" text-align:center">{{ $s->kode }}</td>
                    <td style=" text-align:center">{{ $s->name }}</td>
                    <td style=" text-align:center">{{ $s->namaalamat }}</td>
                    <td style=" text-align:center">{{ $s->namatelepon }}</td>
                    <td style=" text-align:center">{{ $s->tanggal_masuk }}</td>
                    <td style=" text-align:center">{{ $s->statuss }}</td>
                    <td style=" text-align:center">{{ $s->tabungan }}</td>


                </tr>
            @endforeach

        </tbody>
    </table>
    <br>
    <p>Tanggal Cetak {{ $date }}</p>
@endsection
