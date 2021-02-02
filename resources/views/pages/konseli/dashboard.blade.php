{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}
    @php($konseli = $user->details)
    <div class="row">
        <div class="col">
            <div id={{"personal_information__"}} class="mt-8">
                <div class="card border card-custom gutter-b">
                    <div class="card-body">
                        <div class="d-flex mb-9">
                            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3 d-flex flex-column align-items-center">
                                <div class="symbol symbol-50 symbol-lg-120 d-flex align-items-center">
                                    <img id="img-avatar" class="img-fit" src={{{"/avatars/".$user->avatar}}} alt="image">
                                </div>
                                <div class="w-100 d-flex justify-content-center mt-3" id="container__ganti">
                                    <button class="btn btn-warning" id="button__ganti_foto">Ganti Foto</button>
                                    <input type="file" name="input__foto" accept="image/*" hidden>
                                </div>
                                <div class="w-100 justify-content-between mt-3 align-items-center d-none flex-column" id="container__simpan">
                                    <div class="flex-grow-1">
                                        <button class="btn btn-warning " id="button__simpan_foto">Simpan</button>
                                    </div>
                                    <div class="flex-grow-1 mt-2">
                                        <a href="" class="text-danger">Batal</a>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between flex-wrap mt-1">
                                    <div class="d-flex mr-3">
                                        <a href="#"
                                           class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$konseli->nama_konseli}}</a>

                                    </div>
                                </div>
                                <div class="d-flex flex-wrap justify-content-between mt-1">
                                    <div class="flex-grow-1">
                                        <div class="row justify-content-center">
                                            <div class="col-md-3 col-lg-3 mt-4">
                                                <div>
                                                    <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->nim}}</div>
                                                    <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->progdi}}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-lg-2 mt-4">
                                                <div>
                                                    <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->jenis_kelamin}}</div>
                                                    <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->tgl_lahir_konseli}}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-lg-2 mt-4">
                                                <div>
                                                    <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{'Agama: '.$konseli->agama}}</div>
                                                    <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{'Suku: '.$konseli->suku}}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-lg-2 mt-4">
                                                <div>
                                                    <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{'Alamat: '}}</div>
                                                    <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->alamat_konseli}}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-lg-3 mt-4">
                                                <div>
                                                    <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{'No Hp Kerabat'}}</div>
                                                    <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->no_hp_kerabat." - $konseli->hubungan"}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @if($konseling!=null)

                            <div class="separator separator-solid my-8"></div>

                            <div class="d-flex align-items-center flex-wrap mt-8">
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2 flex-grow-1">
                                    <a name={{"konseli__ruangkonseling"}} href="/ruangkonseling"
                                            class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Ruang Konseling
                                    </a>
                                </div>
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2 flex-grow-1">
                                    <button
                                        {{$konseling->conferenced == "ask"?:"disabled"}}
                                        name={{"konseli__caseconference"}} href={{"/setup/caseconference?id="}} class="btn
                                        btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Case Conference</button>
                                </div>
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2 flex-grow-1">
                                    <button name={{"konseli__referral"}} {{$konseling->refered == "ask"?:"disabled"}} id={{"personal_information__referal_"}} class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Referal</button>
                                </div>
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2 flex-grow-1">
                                    <button data-toggle="modal" data-target="#modal__close_case" href="#"
                                            class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Close Case
                                    </button>
                                </div>
                            </div>
                            @else
                            <div class="d-flex align-items-center flex-wrap mt-8">
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2 flex-grow-1">
                                    <a
                                        href="#"
                                            class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3 disabled">Ruang Konseling
                                    </a>
                                </div>
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2 flex-grow-1">
                                    <button
                                        disabled href=""} class="btn
                                        btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Case Conference</button>
                                </div>
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2 flex-grow-1">
                                    <button disabled class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Referal</button>
                                </div>
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2 flex-grow-1">
                                    <button disabled href="#"
                                            class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Close Case
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <script>
            </script>

        </div>
    </div>
    <div class="row mt-12">
        @if($konseling==null)
            <div class="col d-flex flex-column align-items-center justify-content-center0">
                <div class="h1 text-center">
                    KAMU SEDANG TIDAK ADA SESI KONSELING
                </div>
                <div class="h3 text-center my-8">
                    Bagikan kecemasan dan masalahmu dengan konselor yang kamu percaya
                </div>
                <div>
                    <a href="/daftarsesi"
                            class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Daftar Sesi
                    </a>
                </div>
            </div>
        @else
            <div class="col d-flex flex-column align-items-center justify-content-center">
                <div class="h1 text-center">
                    KAMU SEDANG TERDAFTAR KONSELING DENGAN
                </div>
                <div class="h3 text-center mt-8">
                    {{$konseling->konselor->nama_konselor}}
                </div>
                <div class="h4 mt-8">{{$konseling->jadwal->hari.", ".$konseling->jadwal->jam_mulai.":00-".$konseling->jadwal->jam_akhir.":00"}}</div>
                    <span class="text-center">
                        Kamu bisa konseling sesuai jadwal yang telah dipilih dan mengirim pesan kapanpun melalui
                        <a class="text-warning text-hover-warning"
                            href="/ruangkonseling">Ruang Konseling</a>
                    </span>
            </div>
        @endif

        <div class="modal fade" id="modal__close_case" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Akhiri Sesi Konseling</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>Anda yakin ingin mengakhiri sesi konseling?</div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" type="button" class="btn btn-light-warning font-weight-bold">Tolak</button>
                        <button id="button__close_case" type="button" class="btn btn-warning font-weight-bold">Setuju</button>
                    </div>
                </div>
            </div>
        </div>

        @if ($konseling!=null)
        @if($konseling->conferenced == "ask")
        <div class="modal fade" id="modal__case_conference" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pernyataan Persetujuan Case Conference</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>Saya menyetujui dan mengijinkan Konselor saya untuk mendiskusikan kasus saya saat ini dengan Konselor lain. Pernyataan ini saya buat tanpa ada paksaan dari pihak manapun.</div>
                    </div>
                    <div class="modal-footer">
                        <button id="button_caseconference__decline" type="button" class="btn btn-light-warning font-weight-bold">Tolak</button>
                        <button id="button_caseconference__agree" type="button" class="btn btn-warning font-weight-bold">Setuju</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($konseling->refered == "ask")
        <div class="modal fade" id="modal__referral" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pernyataan Persetujuan Referral</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>Saya menyetujui dan mengijinkan Konselor saya untuk merujuk saya ke Konselor lain. Pernyataan ini saya buat tanpa ada paksaan dari pihak manapun.</div>
                    </div>
                    <div class="modal-footer">
                        <button id="button_referral__decline" type="button" class="btn btn-light-warning font-weight-bold">Tolak</button>
                        <button id="button_referral__agree" type="button" class="btn btn-warning font-weight-bold">Setuju</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif

    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        var konseling = @json($konseling);
    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/src/app.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#"+window.location.href.split("#")[1]).modal('show');
        })
        $('#button__ganti_foto').click(function(){
            $('input[name="input__foto"]').click();
        })

        $('input[name="input__foto"]').change(function(){
            $('#container__ganti').removeClass('d-flex');
            $('#container__ganti').addClass('d-none');

            $('#container__simpan').removeClass('d-none');
            $('#container__simpan').addClass('d-flex');
            readImage(this)
        });

        $('#button__simpan_foto').click(function(){
            toastr.options = conf.toastr.options.saving;
            toastr.info("Sedang memproses data")

            axios.post('/services/user/changephoto', {
                'photo': $('#img-avatar').val()
            }).then((res) => {
                Swal.fire({
                    title: 'Foto profil berhasil disimpan',
                    icon: 'success',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((response) => {
                    if(response.value){
                        window.location.reload()
                    }
                })
            })
        })

        function readImage(input) {
            if ( input.files && input.files[0] ) {
                var FR= new FileReader();
                FR.onload = function(e) {
                    console.log(e.target.result)
                    $('#img-avatar').attr( "src", e.target.result );
                    $('#img-avatar').val(e.target.result)
                };
                FR.readAsDataURL( input.files[0] );
            }
        }


    </script>
@endsection
