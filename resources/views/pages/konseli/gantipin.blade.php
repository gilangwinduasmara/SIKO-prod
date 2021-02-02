@extends('layout.default')
@section('styles')
    <style>
        .pin-input{
            width: 32px;
            height: 32px;
        }
        .pin-input:focus{
            outline: none
        }
    </style>
@endsection
@section('content')
    <div class="row align-items-center justify-content-center py-24">
        <div class="col-sm-12 col-lg-6">
            <div class="card card-custom border">
                <div class="card-header">
                    <div class="card-title">Ganti PIN</div>
                </div>
                <div class="card-body">
                    <div class="font-size-h2 text-center mb-6">PIN Lama</div>
                    <div class="row justify-content-center">
                        @for($i=0; $i<6; $i++)
                            <input data-first=true maxlength="1" type="password" pattern="[0-9]*" inputmode="numeric" class="pin-input old border shadow bg-white mx-2 text-center">
                        @endfor
                    </div>
                    <div class="text-danger text-center error-old mt-2"></div>
                    <div class="container__new mt-12" style="display: none">
                        <div class="separator separator-solid mb-6"></div>
                        <div class="font-size-h2 text-center mb-6">PIN Baru</div>
                        <div class="row justify-content-center">
                            @for($i=0; $i<6; $i++)
                                <input maxlength="1" type="password" pattern="[0-9]*" inputmode="numeric" class="pin-input new border shadow bg-white mx-2 text-center">
                            @endfor
                        </div>
                        <div class="text-danger text-center mt-2 error_confirm"></div>
                    </div>
                    <div class="container__confirm mt-12" style="display: none">
                        <div class="separator separator-solid mb-6"></div>
                        <div class="font-size-h2 text-center mb-6">Konfirmasi PIN Baru</div>
                        <div class="row justify-content-center">
                            @for($i=0; $i<6; $i++)
                                <input maxlength="1" type="password" pattern="[0-9]*" inputmode="numeric" class="pin-input confirm border shadow bg-white mx-2 text-center">
                            @endfor
                        </div>
                        <div class="text-danger text-center mt-2 error_confirm">Konfirmasi PIN gagal</div>
                    </div>
                </div>
                <div class="card-footer" style="display: none">
                    <div class="row justify-content-end">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script>
        $($('input')[0]).focus();
    </script>
    <script>
        function isBackspace(event){
            var key = event.keyCode || event.charCoed;
            console.log(event)
            if(key == 8 || key == 46){
                console.log('isbackspace')
                return true
            }
        }
        $('.old').keyup(function(event){
            $('.error-old').text("");
            if(isBackspace(event)){
                $(this).val("")
                $(this).prev('.old').val("");
                $(this).prev('.old').focus();
                return false;
            }

            if(!(/^\d+$/.test($(this).val()))){
                $(this).val("")
                return false
            }

            if($(this).val().length == $(this).attr('maxlength')){
                $(this).next('.old').focus();
            }else{
                $(this).prev('.old').focus();
            }
            let old = "";
            $.each($('.old'), function(){
                old+=($(this).val()+"")
            })
            console.log(old)

            if(old.length == 6){
                toastr.options = conf.toastr.options.saving;
                toastr.info("Sedang memproses data")

                $.each($('.old'), function(){
                    $(this).prop("disabled", true)
                })

                axios.post('/services/auth/gantipin', {
                    old
                }).then((response) => {
                    toastr.clear()
                    console.log(response.data)
                    if(response.data.success){
                        $('.container__new').show();
                        setTimeout(() => {
                            $($('.new')[0]).focus()
                        }, 200);
                    }else{
                        $.each($('.old'), function(){
                            $(this).prop("disabled", false);
                            $(this).val("");
                        })
                        $('.error-old').text(response.data.error)
                        $($('.old')[0]).focus();
                    }

                }).catch((err) => {

                })



            }else{

                $('.container__new').hide();
                $('.container__confirm').hide();
                $.each($('.confirm'), function(){
                    $(this).val("")
                })
            }
            $('.error_confirm').hide();
        })

        $('.new').keyup(function(){
            if(isBackspace(event)){
                $(this).val("")
                $(this).prev('.new').val("");
                $(this).prev('.new').focus();
                return false;
            }

            if(!(/^\d+$/.test($(this).val()))){
                $(this).val("")
                return false
            }
            if($(this).val().length == $(this).attr('maxlength')){
                $(this).next('.new').focus();
            }else{
                $(this).prev('.new').focus();
            }
            let pin = "";
            $.each($('.new'), function(){
                pin+=($(this).val()+"")
            })
            if(pin.length == 6){
                $('.container__confirm').show();
                setTimeout(() => {
                    $($('.confirm')[0]).focus()
                }, 200);
            }else{
                $('.container__confirm').hide();
                $('.card-footer').hide();
                $.each($('.confirm'), function(){
                    $(this).val("")
                })
            }
            $('.error_confirm').hide();
        })



        $('.confirm').keyup(function(){
            if(isBackspace(event)){
                $(this).val("")
                $(this).prev('.confirm').val("");
                $(this).prev('.confirm').focus();
                return false;
            }
            if(!(/^\d+$/.test($(this).val()))){
                $(this).val("")
                return false
            }
            if($(this).val().length == $(this).attr('maxlength')){
                $(this).next('.confirm').focus();
            }else{
                $(this).prev('.confirm').focus();
            }
            let confirmPin = "";
            $.each($('.confirm'), function(){
                confirmPin+=($(this).val()+"")
            })
            if(confirmPin.length == 6){
                let pin = "";
                $.each($('.new'), function(){
                    pin+=($(this).val()+"")
                })
                if(pin == confirmPin){
                    $('.card-footer').show();
                }else{
                    $('.error_confirm').show();
                    $('.card-footer').hide();
                }
            }else{
                $('.error_confirm').hide();
                $('.card-footer').hide();
            }
        })
        $('button').click(function(){
            toastr.options = conf.toastr.options.saving;
            toastr.info("Sedang memproses data")
            let pin = "";
            $.each($('.new'), function(){
                pin+=($(this).val()+"")
            })
            let old = "";
            $.each($('.old'), function(){
                old+=($(this).val()+"")
            })
            axios.post('/services/auth/gantipin', {
                new: pin,
                old
            }).then((res) => {
                console.log(res.data)
                Swal.fire({
                    text: 'Pin berhasil disimpan',
                    allowOutsideClick: false,
                    allowEscapceKey: false,
                    icon: 'success'
                }).then((result) => {
                    if(result.value){
                        window.location.href = "/dashboard";
                    }
                })
            })
        })
    </script>
@endsection
