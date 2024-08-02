<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>SALAMAN</title>
    <!-- CSS files -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet"/>
    {{--ikon untuk title--}}
    <link rel="shortcut icon" href="{{ asset('assets/img/p_letter.png') }}" type="image/x-icon" />
    <link href="{{ asset('tabler/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/demo.min.css?1692870487') }}" rel="stylesheet"/>

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

</head>
<body class=" d-flex flex-column">
<script src="{{ asset('tabler/dist/js/demo-theme.min.js?1692870487') }}"></script>
<div class="page page-center">
    <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg">
                <div class="container-tight">
                    <div class="text-center mb-4">
                        <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36"
                                                                                    alt=""></a>
                    </div>
                    <div class="card card-md">
                        <div class="card-body">
                            <h2 class="h2 text-center mb-4">Silakan Login</h2>
                            @if(Session::get('warning'))
                                <div class="alert alert-warning">
                                    <p>{{ Session::get('warning') }}</p>
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Errors Woy!</strong><br>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{--<form action="/prosesloginsatker" method="POST" autocomplete="off" novalidate>--}}
                            <form action="{{ route('prosesloginsalaman') }}" method="POST" autocomplete="off" >
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Kode User Anda</label>
                                    {{--<input type="email" id="kode_satker" name="kode_satker" class="form-control"--}}
                                    <input type="text" id="kode_user" name="kode_user" class="form-control"
                                           placeholder="User ID" value="{{ old('kode_user') }}"
                                           autocomplete="off" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">
                                        Password
                                        <span class="form-label-description">
                        </span>
                                    </label>
                                    <div class="input-group input-group-flat">
                                        <input type="password" name="password" id="password" class="form-control"
                                               placeholder="Password" autocomplete="off" required>
                                        <span class="input-group-text">
                          <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->

                          </a>
                        </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Roles</label>
                                    <select name="role_user" id="role_user" class="form-select">
                                        <option value="">Pilih Role</option>
                                        <option value="rumah_tangga">Rumah Tangga</option>
                                        <option value="superadmin">Admin</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <div style="text-align: center; margin-bottom: 10px">

                                        <strong>Google Recaptcha</strong>
                                    </div>
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                </div>


                                <div class="form-footer">
                                    <button type="submit" class="btn w-100" style="background-color: #29a9e2;">
                                        <div style="color: white">Sign in</div>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg d-none d-lg-block">

                <div class="row ">
                    <div class="col-12">
                        <center>

                            <img src="{{ asset('assets/img/perisai_2.png') }}" alt="" class="">
                        </center>
                    </div>
                </div>
                <div style="height: 30px;">

                </div>
                <div style="font-style: italic; font-weight: bold">
                    <center>
                        <h1>SALAMAN</h1>
                        <h3>Sistem Layanan Peminjaman</h3>
                        <h2>Sarana & Prasarana</h2>
                    </center>
                </div>
                <div class="row mt-4" >
                    <div class="col-12">
                        <img style="border-radius: 30px; height:350px;" src="{{ asset('tabler/static/illustrations/handshaking.jpeg') }}" height="300"
                             class="d-block mx-auto" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="{{ asset('tabler/dist/js/tabler.min.js?1692870487') }}" defer></script>
<script src="{{ asset('tabler/dist/js/demo.min.js?1692870487') }}" defer></script>

<script>

    // document.getElementsByClassName("g-recaptcha");
    // document.getElementsByClassName('g-recaptcha').setAttribute("style","display:block;width:500px");
    // document.getElementsByClassName('g-recaptcha').style.width='1000px';
    var list, index;
    list = document.getElementsByClassName("g-recaptcha");
    for (index = 0; index < list.length; ++index) {
        list[index].setAttribute("style", "display:block;margin-left:25px");
    }
</script>
</body>
</html>