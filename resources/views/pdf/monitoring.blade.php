@extends('pdf.layout')

@section('content')
    <p style='margin:0cm;margin-bottom:.0001pt;margin-top:2pt;font-size:16px;font-family:"Times New Roman","serif";'>
        <strong>Rekap Monitoring</strong>
    </p>
    <br>
    <br>
    <table class="p">
        <tbody>
            <tr class="">

                <th class="text-center" style="width:5%; text-align:center">No</th>
                <th class="text-center" style="width:10%; text-align:center">Mata Kuliah</th>
                <th class="text-center" style="width:10%; text-align:center">Kelas</th>
                <th class="text-center" style="width:10%; text-align:center">Tanggal</th>
                <th class="text-center" style="width:15%; text-align:center">Jam Masuk - Pulang</th>
                <th class="text-center" style="width:10%; text-align:center">Status Belajar</th>
                <th class="text-center" style="width:10%; text-align:center">Hadir </th>
                <th class="text-center" style="width:15%; text-align:center">Dosen</th>
                <th class="text-center" style="width:10%; text-align:center">Pertemuan</th>
                <th class="text-center" style="width:10%; text-align:center">Status</th>

            </tr>
            @php $no = 1; @endphp
            @foreach ($monitoring as $s)
                <tr>
                    <td style=" text-align:center">{{ $no }}</td>
                    <td style=" text-align:center">{{ $s->namamatkul->nama_matkul }}</td>
                    <td style=" text-align:center">{{ $s->namakelas->nama }}</td>
                    <td style=" text-align:center">{{ $s->tanggal }}</td>
                    <td style=" text-align:center">{{ $s->jam_awal }} - {{ $s->jam_akhir }}</td>
                    <td style=" text-align:center">
                        @if ($s->status_belajar == 1)
                            Luring -{{ $s->namaruang->nama }}
                        @endif
                        @if ($s->status_belajar == 2)
                            During
                        @endif
                    </td>

                    <td style=" text-align:center">{{ $s->jml_hadir }}</td>

                    <td style=" text-align:center">{{ $s->namadosen->name }}</td>
                    <td style=" text-align:center">{{ $s->pertemuan }}</td>
                    <td style=" text-align:center">
                        @if ($s->status_verif == 0)
                            Menunggu
                        @endif
                        @if ($s->status_verif == 1)
                            Disetujui
                        @endif
                        @if ($s->status_verif == 0)
                            'Ditolak'
                        @endif
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
