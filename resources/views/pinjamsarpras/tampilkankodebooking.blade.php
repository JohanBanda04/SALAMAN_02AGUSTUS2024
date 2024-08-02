<form action="#" id="frmDetailBerita" name="frmDetailBerita" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-12">

            <div class="input-icon mb-3">
                <div class="form-group col-lg-12"
                     style="justify-items: end;  ">

                    {{--sementara ini tidak digunakan--}}
                    <div hidden class="row m-l-1" style=" overflow: auto; text-align: center ">
                        {{ $kode_booking }}
                    </div>
                    {{--sampai sini tidak digunakan--}}

                    {{--copying button--}}
                    <div style="padding-bottom: 10%;">
                        <input readonly style="text-align: center; width: 275px;" type="text"
                               value={{ $kode_booking }} id="myInput">

                        <!-- The button used to copy the text -->
                        <button class="btn btn-primary w-100 copy-confirm">Copy Unique Code</button>

                        <script>
                            $(function () {
                                $('.copy-confirm').click(function (e) {
                                    e.preventDefault();
                                    Swal.fire({
                                        title: "Copy Kode Booking?",
                                        text: "Jika Ya, click button Copy",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Copy"
                                    }).then((result)=>{
                                        var copyText = document.getElementById("myInput");

                                        /* Select the text field */
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999);
                                        /*For mobile devices*/

                                        /* Copy the text inside the text field */
                                        document.execCommand("copy");
                                        Swal.fire({
                                            title: "Copied!",
                                            text: "Data Berhasil Disalin",
                                            icon: "success"
                                        });
                                    });
                                });
                            })
                        </script>
                        <script type="application/javascript">
                            function myFunction() {
                                /* Get the text field */
                                var copyText = document.getElementById("myInput");

                                /* Select the text field */
                                copyText.select();
                                copyText.setSelectionRange(0, 99999);
                                /*For mobile devices*/

                                /* Copy the text inside the text field */
                                document.execCommand("copy");

                                /* Alert the copied text */
                                Swal.fire({
                                    title: 'Yeay!',
                                    text: "Kode Booking Telah Disalin!",
                                    icon: 'warning',
                                });
                                return false;

                                //alert("Copied the text: " + copyText.value);
                            }


                        </script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    </div>
                    {{--end of copying button--}}
                </div>


            </div>
        </div>
    </div>


</form>