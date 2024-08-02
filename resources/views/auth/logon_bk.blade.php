<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>E-Presensi Geolocation</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html"/>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">

    <style>
        .datepicker-modal {
            max-height: 430px !important;
        }

        .datepicker-date-display {
            background-color: #0f3a7e !important;
        }
    </style>

</head>

<body class="bg-white">



<!-- loader -->
<div id="loader">
    <div class="spinner-border text-primary" role="status"></div>
</div>
<!-- * loader -->


<!-- App Capsule -->
<div style="height: 70px;">

</div>
<div id="appCapsule" class="pt-0">

    <div class="login-form mt-1">
        <div class="section">
            <img src="{{ asset('assets/img/login/sarpras.jpg') }}" alt="image" style="border-radius: 20px;"
                 class="form-image">
        </div>
        <div class="section mt-0">
            <h1>SIPARAS</h1>
            <br>
            <h1>Sistem Pinjam Sarpras</h1>
            <h4>Pilih Layanan</h4>
        </div>
        <div class="section mt-1 mb-5">
            @php
                $messagewarning = \Illuminate\Support\Facades\Session::get("warning");
            @endphp
            @if(\Illuminate\Support\Facades\Session::get('warning'))
                <div class="alert alert-outline-warning">
                    {{  $messagewarning }}
                </div>
            @endif


            {{--pinjam kendaraan--}}
            <div style="width: 100%;
    height: 100%;
    display: table;
    text-align: center;" class="card gradasigreen">
                <a href="{{ route('formpinjamkendaraan') }}" id="btnTambahPinjamKendaraan" style="text-decoration: none; color:white">
                    <div class="card-body">
                        <div class="presencecontent">
                            Pinjam Kendaraan
                        </div>
                    </div>
                </a>

            </div>
            <br>

            {{--pinjam ruangan--}}
            <div style="width: 100%;
    height: 100%;
    display: table;
    text-align: center;" class="card gradasired">
                <a href="{{ route('formpinjamruangan') }}" id="btnTambahPinjamRuangan" style="text-decoration: none; color:white">
                    <div class="card-body">
                        <div class="presencecontent">
                            Pinjam Ruangan
                        </div>
                    </div>
                </a>

            </div>


            {{--PINJAM KENDARAAN--}}
            <div class="modal modal-blur fade" id="modal-inputpinjamkendaraan" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Peminjaman Kendaraan</h5>
                            <button style="height: 15px; width: 15px;" type="button" class="btn btn-primary btn-close"
                                    data-dismiss="modal" aria-label="Close">X
                            </button>
                        </div>
                        <div class="modal-body" id="loadtambah_form_pinjamkendaraan">
                            <form action="{{  route('storepinjamkendaraan') }}" method="post" id="frmPinjaKendaraan"
                                  name="frmPinjaKendaraan"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="input-icon mb-3">
                                            <input type="text" value="" class="form-control"
                                                   name="nama_peminjam"
                                                   id="nama_peminjam"
                                                   placeholder="Nama Peminjam">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" id="tgl_izin" name="tgl_izin"
                                                   class="form-control datepicker" placeholder="Tanggal">
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            {{--PINJAM RUANGAN--}}
            <div class="modal modal-blur fade" id="modal-inputpinjamruangan" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Peminjaman Ruangan</h5>
                            <button hidden class="btn btn-secondary cur-p float-left" data-dismiss="modal" name="">
                                Kembali
                            </button>
                            <button style="height: 15px; width: 15px;" type="button" class="btn btn-primary btn-close"
                                    data-dismiss="modal" aria-label="Close">X
                            </button>
                        </div>
                        <div class="modal-body" id="loadtambah_form_pinjamruangan">

                        </div>

                    </div>
                </div>
            </div>


            <div hidden class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>

            <div hidden class="form-group boxed">
                <div class="input-wrapper">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>

            <div class="form-links mt-2">

                {{--<div><a href="page-forgot-password.html" class="text-muted">Forgot Password?</a></div>--}}
            </div>

            {{--<div class="form-button-group">--}}
                {{--<button type="submit" class="btn btn-success btn-block btn-lg">Log in</button>--}}
                {{--<button type="submit" class="btn btn-block btn-lg" style="background-color: #1a202c; color: white">Kirim</button>--}}
            {{--</div>--}}

        </div>
    </div>


</div>
<!-- * App Capsule -->


<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
<!-- Bootstrap-->
<script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
<!-- Owl Carousel -->
<script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<!-- jQuery Circle Progress -->
<script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
<!-- Base Js File -->
<script src="{{ asset('assets/js/base.js') }}"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script>
    $(document).ready(function () {
        $(".datepicker").datepicker({

            format: "yyyy-mm-dd"
        });
    });
</script>
<script>
    $(function () {
        // $('#btnTambahPinjamKendaraan').click(function () {
        //     $('#modal-inputpinjamkendaraan').modal('show');
        // });

        // $('#btnTambahPinjamRuangan').click(function () {
        //     $('#modal-inputpinjamruangan').modal('show');
        // });

        $("#dari, #sampai").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        });
    });
</script>
</body>

</html>