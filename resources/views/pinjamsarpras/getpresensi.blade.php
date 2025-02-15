@php
    function selisih($jam_masuk, $jam_keluar)
           {
               list($h, $m, $s) = explode(":", $jam_masuk);
               $dtAwal = mktime($h, $m, $s, "1", "1", "1");
               list($h, $m, $s) = explode(":", $jam_keluar);
               $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
               $dtSelisih = $dtAkhir - $dtAwal;
               $totalmenit = $dtSelisih / 60;
               $jam = explode(".", $totalmenit / 60);
               $sisamenit = ($totalmenit / 60) - $jam[0];
               $sisamenit2 = $sisamenit * 60;
               $jml_jam = $jam[0];
               return $jml_jam . ":" . round($sisamenit2);
           }
@endphp
@foreach($presensi as $d)
    @php
        $foto_in = Storage::url('uploads/absensi/'.$d->foto_in);
        $foto_out = Storage::url('uploads/absensi/'.$d->foto_out);
    @endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->nama_lengkap }}</td>
        <td>{{ $d->kode_dept }}</td>
        <td>{{ $d->nama_jam_kerja }} ({{ $d->jam_masuk }} s/d {{ $d->jam_pulang }})</td>
        <td>{{ $d->jam_in }}</td>
        <td>
            <img src="{{ url($foto_in) }}" class="avatar" alt="">
        </td>
        <td>
            @if($d->jam_out==null || $d->jam_out=='00:00:00')
                <span class="badge bg-danger" style="color: white">Belum Absen Pulang</span>
            @endif

            @if($d->jam_out!=null AND $d->jam_out!='00:00:00')
                <span class="badge bg-success" style="color: white">{{ $d->jam_out }}</span>
            @endif
            {{--{!!  $d->jam_out!=null ? $d->jam_out:'<span class="badge bg-danger" style="color: white">Belum Absen Pulang</span>' !!}--}}
        </td>
        <td>
            {{--@if($d->jam_out!=null)
                <img src="{{ url($foto_out) }}" class="avatar" alt="">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hourglass-high" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M6.5 7h11"/>
                    <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z"/>
                    <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z"/>
                </svg>
            @endif--}}

            @if($d->jam_out==null || $d->jam_out=='00:00:00')
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hourglass-high" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M6.5 7h11"/>
                    <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z"/>
                    <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z"/>
                </svg>
            @endif

            @if($d->jam_out!=null AND $d->jam_out!='00:00:00')
                <img src="{{ url($foto_out) }}" class="avatar" alt="">
            @endif
        </td>
        <td>

            @if($d->jam_in >= $d->jam_masuk)
                @php
                    $jamterlambat = selisih($d->jam_masuk,$d->jam_in);
                @endphp
                <span class="badge bg-danger" style="color: white">Terlambat {{ $jamterlambat }}</span>
            @else
                <span class="badge bg-success" style="color: white">Tepat Waktu</span>
            @endif
        </td>
        <td>
            <a href="#" class="btn btn-primary tampilkanpeta" id="{{ $d->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5"/>
                    <path d="M9 4v13"/>
                    <path d="M15 7v5.5"/>
                    <path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z"/>
                    <path d="M19 18v.01"/>
                </svg>
                Lihat Detail
            </a>
        </td>
    </tr>
@endforeach
<script>
    $(function(){
        $('.tampilkanpeta').click(function(e){
            /*cara ambil value*/

            var id = $(this).attr("id");
            //alert(id);
            $.ajax({
                type : 'POST',
                url : '/tampilkanpeta',
                data : {
                    _token:"{{ csrf_token() }}",
                    id: id,
                },
                cache: false,
                success: function(respond){
                    /*cara load ke element html*/
                    $("#loadmap").html(respond);
                },
            });
            $('#modal-tampilkanpeta').modal('show');
        });
    });
</script>