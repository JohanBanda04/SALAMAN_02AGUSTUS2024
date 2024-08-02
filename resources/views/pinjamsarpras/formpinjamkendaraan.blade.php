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
        <div class="pageTitle">Form Pinjam Kendaraan</div>
        <div class="right"></div>
    </div>
@endsection
@section('content')
    <div class="row" style="margin-top: 70px;">
        <div class="col">
            <form class="addPinjamKendaraan" action="{{ route('storepinjamkendaraan') }}" method="post" id="frmPinjamKendaraan"
                  name="frmPinjamKendaraan"
                  enctype="multipart/form-data">
                @csrf
                <div class="input-icon">
                    <input type="text" value="" class="form-control"
                           name="perihal_pinjaman"
                           id="perihal_pinjaman"
                           placeholder="Perihal Pinjaman">

                </div>
                <div class="form-group">
                    <input type="text" id="mulai_tgl" name="mulai_tgl"
                           class="form-control datepicker" placeholder="Mulai Tanggal">
                </div>
                <div class="form-group">
                    <input type="text" id="sampai_tgl" name="sampai_tgl"
                           class="form-control datepicker" placeholder="Sampai Tanggal">
                </div>
                <div class="input-icon">
                    <input type="text" value="" class="form-control"
                           name="penanggung_jawab"
                           id="penanggung_jawab"
                           placeholder="Penanggung Jawab">

                </div>

                <div class="form-group">
                    <label class="" for="subbidang_kode">Subbidang</label>
                    <select name="subbidang_kode" id="subbidang_kode" class="form-control">
                        <option value="">-Pilih Subbidang-</option>
                        @foreach($subbidangs as $index=>$subbidang)
                            <option value="{{ $subbidang->kode_subbid }}">{{ $subbidang->name_subbid }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="" for="kode_kendaraan">Plat Kendaraan</label>
                    <select name="kode_kendaraan" id="kode_kendaraan" class="form-control">
                        <option value="">-Pilih Kendaraan-</option>
                        @foreach($kendaraans as $index=>$kendaraan)
                            <option value="{{ $kendaraan->kode_kendaraan }}">{{ $kendaraan->name_kendaraan }}
                                ({{ $kendaraan->plat_kendaraan }})
                            </option>
                        @endforeach
                        {{--<option value="i">Izin</option>--}}
                        {{--<option value="s">Sakit</option>--}}
                    </select>
                </div>
                <div class="form-group">
                    <label class="" for="datadukung">Upload Data (Nodin / SP)</label>

                    <input type="file" name="datadukung" id="datadukung" onchange="checkSelectedFile(id)"
                           class="form-control">

                    <div>
                        <small class="lh-1 c-red-500"><i>.pdf .doc .docx .ppt .pptx</i></small>
                    </div>

                </div>
                <div class="form-group">
                    <label class="" for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control">

                            </textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary w-100">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('myscript')
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
        function checkSelectedFile(id) {
            //console.log(id);
            fileName = document.querySelector('#' + id).value;
            extension = fileName.split('.').pop();


            if (document.getElementById(id).files.length == 0) {
                console.log("no files selected");
                //$('#'+id).prop('required', true);
                $('#' + id).prop('required', false);
            } else {
                console.log("there are files selected");
                // $('#'+id).prop('required',false);

                if (extension != 'pdf' && extension != 'doc' && extension != 'docx') {
                    //alert("ekstensi file harus PDF, DOC, atau DOCX");
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Ekstensi file harus PDF, DOC, atau DOCX',
                        type: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((res) => {
                        document.querySelector('#' + id).value = '';
                        //$('#'+id).prop('required',true);
                        $('#' + id).prop('required', false);
                    });

                } else {
                    const oFile = document.getElementById(id).files[0];
                    console.log(id);
                    console.log(oFile);
                    $('#' + id).prop('required', false);

                    if (oFile.size > (5 * (1024 * 1024))) // 500Kb for bytes.
                    {
                        //alert("size file terlalu besar");
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Size lampiran terlalu besar',
                            type: 'warning',
                            confirmButtonText: 'Ok'
                        }).then((rslt) => {
                            document.querySelector('#' + id).value = '';
                            //$('#'+id).prop('required',true);
                            $('#' + id).prop('required', false);
                        });

                    }
                }


            }

        }

        $('.storePinjamKendaraan').click(function(){

        });

        $('#frmPinjamKendaraan').submit(function () {
            var perihal_pinjaman = $('#frmPinjamKendaraan').find('#perihal_pinjaman').val();
            var mulai_tgl = $('#frmPinjamKendaraan').find('#mulai_tgl').val();
            var sampai_tgl = $('#frmPinjamKendaraan').find('#sampai_tgl').val();
            var penanggung_jawab = $('#frmPinjamKendaraan').find('#penanggung_jawab').val();
            var subbidang_kode = $('#frmPinjamKendaraan').find('#subbidang_kode').val();
            var kode_kendaraan = $('#frmPinjamKendaraan').find('#kode_kendaraan').val();
            var datadukung = $('#frmPinjamKendaraan').find('#datadukung').val();
            var keterangan = $('#frmPinjamKendaraan').find('#keterangan').val();


            if (perihal_pinjaman == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Perihal Pinjaman Harus Diisi',
                    icon: 'warning',
                }).then((result) => {
                    $('#perihal_pinjaman').focus();
                });
                return false;
            } else if (mulai_tgl == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Tanggal Mulai Harus Diisi',
                    icon: 'warning',
                }).then((result)=>{
                    $('#mulai_tgl').focus();
                });
                return false;
            } else if (sampai_tgl == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Tanggal Akhir Harus Diisi',
                    icon: 'warning',
                }).then((result)=>{
                    $('#sampai_tgl').focus();
                });
                return false;
            } else if (penanggung_jawab == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Penanggungjawab Harus Diisi',
                    icon: 'warning',
                }).then((result)=>{
                    $('#penanggung_jawab').focus();
                });
                return false;
            } else if (subbidang_kode == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Subbidang Harus Diisi',
                    icon: 'warning',
                }).then((result)=>{
                    $('#subbidang_kode').focus();
                });
                return false;
            } else if (kode_kendaraan == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Kendaraan Harus Diisi',
                    icon: 'warning',
                }).then((result)=>{
                    $('#kode_kendaraan').focus();
                });
                return false;
            } else if (datadukung == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Data Dukung Harus Dilampirkan',
                    icon: 'warning',
                }).then((result)=>{
                    $('#datadukung').focus();
                });
                return false;
            } else if (keterangan == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Keterangan Harus Diisi',
                    icon: 'warning',
                }).then((result)=>{
                    $('#keterangan').focus();
                });
                return false;
            }
            {{--else {--}}
                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--url: '{{ route('storepinjamkendaraan') }}',--}}
                    {{--cache: false,--}}
                    {{--data: {--}}
                        {{--_token: '{{ csrf_token() }}',--}}
                        {{--data : "perihal_pinjaman="+perihal_pinjaman+"&mulai_tgl="+mulai_tgl+"&sampai_tgl="+sampai_tgl+"&penanggung_jawab="+penanggung_jawab+"&subbidang_kode="+subbidang_kode+"&kode_kendaraan="+kode_kendaraan+"&datadukung="+datadukung+"&keterangan="+keterangan,--}}
                        {{--success: function(respond){--}}
                        //     Swal.fire({
                        //         title: "Tersimpan!",
                        //         text: "Data Berhasil Disimpan",
                        //         icon: "success"
                        //     });
                        {{--}--}}

                    {{--},--}}
                {{--});--}}
            {{--}--}}

        });

    </script>
@endpush