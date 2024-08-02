@extends('layouts.presensi')
@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <style>
        .datepicker-modal {
            max-height: 430px !important;
        }

        .datepicker-date-display {
            background-color: #0f3a7e !important;
        }
    </style>
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Cek Kode Booking</div>
        <div class="right"></div>
    </div>
@endsection
@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" value="" class="form-control"
                               name="kode_booking"
                               id="kode_booking"
                               placeholder="Kode Booking">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="jenis_pinjaman" id="jenis_pinjaman" class="form-control">
                            <option value="">-Pilih Jenis Pinjaman-</option>
                            <option {{ Request('jenis_pinjaman')=='pinjam_kendaraan'?'selected':'' }} value="pinjam_kendaraan">Pinjam Kendaraan</option>
                            <option {{ Request('jenis_pinjaman')=='pinjam_ruangan'?'selected':'' }} value="pinjam_ruangan">Pinjam Ruangan</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon">
                        <button class="btn btn-primary btn-block" id="getdata">
                            <ion-icon name="search-outline"></ion-icon>
                            {{--ASLIII--}}
                            Cek Status
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" id="showhistori">

        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function () {
            $('#getdata').click(function (e) {
                var kode_booking = $('#kode_booking').val();
                var jenis_pinjaman = $('#jenis_pinjaman').val();
                if (kode_booking == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Kode Booking Belum Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $('#kode_booking').focus();
                    });
                    return false;
                } else if (jenis_pinjaman == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Jenis Pinjaman Belum Dipilih',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $('#jenis_pinjaman').focus();
                    });
                    return false;
                } else {
                    $.ajax({
                        type : 'POST',
                        url : '{{ route('showhistori') }}',
                        data : {
                            _token : "{{ csrf_token() }}",
                            kode_booking : kode_booking,
                            jenis_pinjaman : jenis_pinjaman,
                        },
                        cache: false,
                        success: function(respond){
                            $('#showhistori').html(respond);
                        },
                    });
                }
                //alert(kode_booking);
                //return false;
            });
        });
    </script>
    <script>
        var currYear = (new Date()).getFullYear();

        $(document).ready(function () {
            $(".datepicker").datepicker({

                format: "yyyy-mm-dd"
            });
        });

        $('#mulai_tgl, #sampai_tgl').change(function (e) {
            var tgl_izin = $(this).val();
            //alert(tgl_izin);
            $.ajax({
                type: 'POST',
                url: '/presensi/cekpengajuanizin',
                data: {
                    _token: "{{ csrf_token() }}",
                    tgl_izin: tgl_izin
                },
                cache: false,
                success: function (respond) {
                    if (respond == 1) {
                        Swal.fire({
                            title: 'Oops!',
                            text: 'Anda Sudah Melakukan Input Pengajuan Izin Pada Tanggal Tersebut',
                            icon: 'warning',
                        }).then((result) => {
                            $('#tgl_izin').val("");
                        });
                    }
                }
            });
        });

        $('#frmIzin').submit(function () {
            var tgl_izin = $('#tgl_izin').val();
            var status = $('#status').val();
            var keterangan = $('#ket').val();

            if (tgl_izin == "") {
                // alert('Tgl Harus Diisi');
                Swal.fire({
                    title: 'Oops!',
                    text: 'Tanggal Harus Diisi',
                    icon: 'warning',
                });
                return false;
            } else if (status == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Status Harus Diisi',
                    icon: 'warning',
                });
                return false;
            } else if (keterangan == " ") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Keterangan Harus Diisi',
                    icon: 'warning',
                });
                return false;
            }
        });

    </script>
@endpush