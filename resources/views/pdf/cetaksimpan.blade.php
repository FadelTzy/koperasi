@extends('pdf.layout')

@section('content')
    <div style="text-align: center">


        <p style='margin:0cm;margin-bottom:.0001pt;margin-top:2pt;font-size:20px;font-family:"serif";'>
            <strong>DATA LAPORAN SIMPANAN</strong>
        </p>
    </div>
    <br>
    <br>
    <br>
    <table class="p">
        <tbody>
            <tr class="">

                <th class="text-center" style="width:5%; text-align:center">No</th>
                <th class="text-center" style="width:5%; text-align:center">Kode Simpanan</th>
                <th class="text-center" style="width:5%; text-align:center">Nama</th>
                <th class="text-center" style="width:5%; text-align:center">Tgl Pengajuan</th>
                <th class="text-center" style="width:5%; text-align:center">Nama Simpanan</th>
                <th class="text-center" style="width:5%; text-align:center">Besaran Simpanan </th>
                <th class="text-center" style="width:5%; text-align:center">Status Pengajuan</th>


            </tr>
            @php
                $no = 1;
                $total = [];
            @endphp
            @foreach ($data->getData()->data as $s)
                <tr>
                    <td style=" text-align:center">{{ $no++ }}</td>
                    <td style=" text-align:center">{{ $s->kode_simpan }}</td>
                    <td style=" text-align:center">{{ $s->np }}</td>
                    <td style=" text-align:center">{{ $s->tanggal }}</td>
                    <td style=" text-align:center">{{ $s->nama_simpanan }}</td>

                    <td style=" text-align:center">Rp. {{ $s->total_simpanan }}</td>
                    <td style=" text-align:center">{{ $s->status_pe }}</td>


                </tr>
            @endforeach

        </tbody>
    </table>
    <br>
    <p>Tanggal Cetak {{ $date }}</p>
@endsection
