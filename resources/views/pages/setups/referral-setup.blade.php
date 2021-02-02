{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-row">
            <div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px" id="kt_chat_aside">
                <div class="card card-custom bg-light h-100vh">
                    <div class="card-header border-0 pt-5">
                        <div class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark h1">Referral</span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Merujuk konseli ke konselor lain</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-custom glutter-b card-stretch">
                            <div id="step-card-1" class="card-body {{($konseling->refered == "tidak" || $konseling->refered == "declined" )? 'bg-white': 'bg-light'}}">
                                <div class="card-title">
                                    <span>1. Persetujuan Referral</span><br>
                                    <span class="text-muted">Meminta persetujuan ke konseli untuk merujuk mereka ke konselor lain</span>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom glutter-b card-stretch mt-3 card-shadowless">
                            <div id="step-card-2" class="card-body {{$konseling->refered == "agreed"? 'bg-white': 'bg-light'}}">
                                <div class="card-title">
                                    <span>2. Memilih Konselor</span><br>
                                    <span class="text-muted">Memilih konselor yang akan menerima rujukan</span>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom glutter-b card-stretch mt-3 card-shadowless">
                            <div id="step-card-3" class="card-body bg-light">
                                <div class="card-title">
                                    <span>3. Memasukkan Pesan Referral</span><br>
                                    <span class="text-muted">Memasukkan Pesan Referral yang akan dibaca oleh konselor yang dirujuk</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-7 scroll scroll-pull ps ps--active-y" style="height: 12px; overflow: hidden;">

                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 12px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: -28px; height: 40px;"></div></div></div>
                    </div>
                </div>
            </div>
            <div class="flex-row-fluid ml-lg-8" id="kt_chat_content">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none" id="kt_app_chat_toggle">
                                <span class="svg-icon svg-icon-lg">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo5/dist/assets/media/svg/icons/Communication/Adress-book2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3"></path>
                                            <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </button>
                            <span>{{$konseling->konseli->nama_konseli}}</span>
                        </div>
                    </div>
                    @if (in_array($konseling->refered, ['tidak', 'ask', 'declined']))
{{--                        {!! $konseling !!}--}}
                        <div class="card-body">
                            <div class="h1">1. Persetujuan Referral</div>
                            <div class="text-muted mt-3 font-weight-bold font-size-sm ml-7">Sebelum melakukan Referral , mintalah persetujuan dari konseli.</div>
                            @if($konseling->refered === 'tidak')
                            <div class="mt-3 ml-7">
                                <input type="checkbox" id="checkbox__persetujuan"><label class="ml-3 text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1" for="persetujuan">Minta persetujuan Referral</label><br>
                                <div>
                                    <button id="button__ask_referral" disabled class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Kirim</button>
                                </div>
                            </div>
                            @elseif($konseling->refered === 'ask')
                            <div class="mt-3 ml-7">
                                <div class=" text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1" for="persetujuan">Permintaan persetujuan Referral telah dikirim ke konseli</div>
                            </div>
                            @endif
                        </div>
                        @else
                            @if ($konseling->refered == 'agreed')
                            <div class="card-body" id="step_2">
                                    <div class="h1">2. Memilih Conselor</div>
                                    <div class="text-muted mt-3 font-weight-bold font-size-sm ml-7">Pilih konselor yang akan menerima rujukan</div>
                                    <div class="card card-custom card-stretch gutter-b card-shadowless bg-light mt-8">
                                        <div class="card-body py-3">
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-12 mb-8">
                                                    <div class="card card-custom">
                                                        <!--begin::Body-->
                                                        <div class="card-body">
                                                            <!--begin:Search-->
                                                            <div class="input-group input-group-solid">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <span class="svg-icon svg-icon-lg">
                                                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo5/dist/assets/media/svg/icons/General/Search.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                                <input id="input__cari" type="text" class="form-control py-4 h-auto" placeholder="Cari">
                                                            </div>
                                                            <!--end:Search-->
                                                            <!--begin:Users-->
                                                            <div class="mt-7">
                                                                <table id="table_list">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($konselors as $konselor)
                                                                        <tr>
                                                                            <td>
                                                                                <div class="d-flex align-items-center justify-content-between mb-5">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <div class="symbol symbol-circle symbol-50 mr-3">
                                                                                            <img class="img-fit" alt="Pic" src={{"/avatars/".$konselor->user->avatar}}>
                                                                                        </div>
                                                                                        <div class="d-flex flex-column">
                                                                                            <a data id={{"daftarkonselor__".$konselor->id}} href="#chat-container" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{$konselor->nama_konselor}}</a>
                                                                                            <span class="text-muted font-weight-bold font-size-sm">{{ $konselor->profesi_konselor }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="d-flex flex-column align-items-end">
                                                                                        {{-- <span class="text-muted font-weight-bold font-size-sm">35 mins</span> --}}
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <!--end:Users-->
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-sm-12 mb-8">
                                                    @include('pages.widgets._konselor-selector')
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button disabled class="btn btn-warning" id="button__daftar_sesi_referral">Lanjut</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="card-body" id="step_3" style="display: none">
                                <div class="h1">3. Memasukkan Pesan Referral</div>
                                <div class="text-muted mt-3 font-weight-bold font-size-sm ml-7">Masukkan pesan referral untuk konselor yang dirujuk</div>
                                <div class="form-group ml-7 mt-7" hidden >
                                    <label>Topik:  </label>
                                    <input type="text" class="form-control" value="" id="input__topik"/>
                                </div>
                                <div class="form-group ml-7 mt-7" >
                                    <label>Pesan:  </label>
                                    <textarea type="text" class="form-control" id="input__pesan"></textarea>
                                </div>
                                <div class="card-body py-3">
                                    <button id="button__submit_referral" disabled class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3" value="Kirim" type="submit">Kirim Referral</button>
                                </div>
                            </div>
                            @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        var konselors = @json($konselors);
    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/chat/chat.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/list.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/setup.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/konselorselector.js') }}" type="text/javascript"></script>
    <script>

        let searchParams = new URLSearchParams(window.location.search);
        @if($konseling->refered == 'agreed')
        $("#content-wrapper").removeClass("container")
        $("#content-wrapper").addClass("container-fluid")
        @endif
        $('#button__daftar_sesi').hide();
        $('#button__daftar_sesi_referral').click(function(){
            $('#step-card-2').removeClass("bg-white")
            $('#step-card-2').addClass("bg-light")
            $('#step-card-3').removeClass("bg-light")
            $('#step-card-3').addClass("bg-white")
            $('#step_2').hide();
            $('#step_3').show();
            $("#content-wrapper").removeClass("container-fluid")
            $("#content-wrapper").addClass("container")
        })

        $("#input__pesan").keyup(function(){
            if($(this).val().length == 0){
                $('#button__submit_referral').prop('disabled', true)
            }else{
                $('#button__submit_referral').prop('disabled', false)
            }
        })

        $('#button__submit_referral').click(function(){
            $(this).attr('disabled', 'true')
            const data = {
                // judul_referral: $("#input__topik").val(),
                pesan_referral: $("#input__pesan").val(),
                jadwal_konselor_id: $("#input__jadwal_konselor_id").val(),
                konseling_id: searchParams.get("id"),
                konselor_tujuan_id: $("#input__konselor_id").val()
            }
            axios.post("/services/referral", data).then(res => {
                if(res.data.success){
                    window.location.href = "/daftarkonseli";
                }else{
                    Swal.fire({
                        title: '',
                        text: res.data.error
                    }).then(function(result){
                        if(result.value){
                            if(res.data.redirect){
                                window.location.href = res.data.redirect
                            }
                        }
                    })
                }
            })
        })
    </script>
@endsection
