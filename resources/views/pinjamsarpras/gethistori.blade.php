{{--@if($histori->isEmpty())
    <div class="alert alert-outline-warning">
        <p>Data Belum Ada</p>
    </div>
@endif--}}
{{--@foreach($histori as $d)--}}
@if(count($getdata)<=0)
    <div class="alert alert-outline-warning">
        <p>Data Belum Ada</p>
    </div>
@elseif(count($getdata)>0)
    @foreach($getdata as $index=>$gdata)
        <ul class="listview image-listview">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            <b>{{ $gdata->kode_booking }}</b> <br>
                        </div>
                    </div>
                </div>
                <div class="item">

                    <?php
                    if($gdata->status == "Pengajuan Pinjaman"){
                    ?>
                    <span class="badge bg-warning" style="margin-left: -5px; color: white;">
                    Menunggu Persetujuan
                    </span>
                    <?php
                    } else if ($gdata->status == "Disetujui") { ?>
                    <span class="badge bg-success" style="margin-left: -5px; color: white;">
                    Telah Disetujui
                    </span>
                    <?php

                    } else if ($gdata->status == "Ditolak") { ?>
                    <span class="badge bg-danger" style="margin-left: -5px; color: white;">
                    Telah Ditolak
                    </span>
                    <?php

                    }

                    ?>

                </div>
            </li>
        </ul>
    @endforeach
@endif

{{--@endforeach--}}