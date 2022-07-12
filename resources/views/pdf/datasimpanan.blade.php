@extends('pdf.layout')

@section('content')
    <div style="text-align: center">


        <p style='margin:0cm;margin-bottom:.0001pt;margin-top:2pt;font-size:20px;font-family:"serif";'>
            <strong>DATA LAPORAN SIMPANAN ANGGOTA</strong>
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
                <th class="text-center" style="width:10%; text-align:center">Tanggal Simpanan</th>
                <th class="text-center" style="width:10%; text-align:center">Nama Simpanan</th>
                <th class="text-center" style="width:10%; text-align:center">Jumlah Simpanan</th>


            </tr>
            @php
                $no = 1;
                $total = [];
            @endphp
            @foreach ($monitoring as $s)
                <tr>
                    <td style=" text-align:center">{{ $no++ }}</td>
                    <td style=" text-align:center">{{ $s->tanggal }}</td>
                    <td style=" text-align:center">{{ $s->nama_simpanan }}</td>
                    <td style=" text-align:center">{{ $s->total_simpanan }}</td>

                    @php $total[] = $s->total_simpanan; @endphp

                </tr>
            @endforeach
            <tr>
                <td colspan="3" style=" text-align:center">Total</td>
                <td style=" text-align:center">{{ array_sum($total) }}</td>

            </tr>
        </tbody>
    </table>
    <br>
    <p>Tanggal Cetak {{ $date }}</p>
@endsection
