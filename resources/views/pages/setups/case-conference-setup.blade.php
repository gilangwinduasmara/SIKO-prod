{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="container">
        <div class="d-flex flex-row">
            <div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px" id="kt_chat_aside">
                <div class="card card-custom bg-light h-100vh">
                    <div class="card-header border-0 pt-5">
                        <div class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark h1">Case Conference</span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm">Melakukan konferensi dengan konselor lain untuk mendapatkan solusi terbaik</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-custom glutter-b card-stretch">
                            <div class="{{$konseling->conferenced == 'tidak' || $konseling->conferenced == 'ask' ? 'card-body bg-white' : 'card-body bg-light' }}">
                                <div class="card-title">
                                    <span>1. Persetujuan Case Conference</span><br>
                                    <span class="text-muted">Meminta persetujuan ke konseli untuk mendiskusikan permasalahan mereka.</span>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom glutter-b card-stretch mt-3 card-shadowless">
                            <div class="{{$konseling->conferenced == 'agreed' ? 'card-body bg-white' : 'card-body bg-light' }}" id="step-card-2">
                                <div class="card-title">
                                    <span>2. Memilih Konselor</span><br>
                                    <span class="text-muted">Memilih konselor untuk melakukan Case Conference</span>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom glutter-b card-stretch mt-3 card-shadowless">
                            <div class="card-body bg-light" id="step-card-3">
                                <div class="card-title">
                                    <span>3. Melakukan Case Conference</span><br>
                                    <span class="text-muted">Melakukan Case Conference dengan konselor yang telah dipilih.</span>
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
                    @if (in_array($konseling->conferenced, ['tidak', 'ask', 'declined']))
{{--                        {!! $konseling !!}--}}
                        <div class="card-body">
                            <div class="h1">1. Persetujuan Case Conference</div>
                            <div class="text-muted mt-3 font-weight-bold font-size-sm ml-7">Sebelum melakukan Case Conference , mintalah persetujuan dari konseli.</div>
                            @if($konseling->conferenced === 'tidak')
                            <div class="mt-3 ml-7">
                                <input type="checkbox" id="checkbox__persetujuan"><label class="ml-3 text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1" for="persetujuan">Minta persetujuan Case Conference</label><br>
                                <div>
                                    <button id="button__ask_case_conference" disabled class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Kirim</button>
                                </div>
                            </div>
                            @elseif($konseling->conferenced === 'ask')
                            <div class="mt-3 ml-7">
                                <div class=" text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1" for="persetujuan">Permintaan persetujuan Case Conference telah dikirim ke konseli</div>
{{--                                <div>--}}
{{--                                    <button id="button__ask_case_conference" disabled class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3">Kirim</button>--}}
{{--                                </div>--}}
                            </div>
                            @endif
                        </div>
                        @else
                            @if ($konseling->conferenced == 'agreed')
                            <div class="card-body" id="step_2">
                                    <div class="h1">2. Memilih Conselor</div>
                                    <div class="text-muted mt-3 font-weight-bold font-size-sm ml-7">Pilih konselor (bisa lebih dari 1) untuk melakukan Case Conference</div>
                                    <div class="card card-custom card-stretch gutter-b card-shadowless bg-light mt-8">
                                        <div class="card-body py-3">
                                            <div class="table-responsive">
                                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                                                    <thead>
                                                        <tr class="text-left">
                                                            <th class="pl-0" style="width: 20px">
                                                                <label class="checkbox checkbox-lg checkbox-inline">
                                                                    <input type="checkbox" value="1">
                                                                    <span></span>
                                                                </label>
                                                            </th>
                                                            <th class="pr-0" style="width: 50px">Konselor</th>
                                                            <th style="min-width: 200px"></th>
                                                            <th style="min-width: 150px">Profesi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($konselors as $konselor)
                                                            <tr>
                                                                <td class="pl-0">
                                                                    <label class="checkbox checkbox-lg checkbox-inline">
                                                                        <input id={{"checkbox__konselor_selector_".$konselor->id}} type="checkbox" value="{{$konselor->id}}">
                                                                        <span></span>
                                                                    </label>
                                                                </td>
                                                                <td class="pr-0">
                                                                    <div class="symbol symbol-50 symbol-light mt-1">
                                                                        <span class="symbol-label">
                                                                            <img src={{"/avatars/".$konselor->user->avatar}} class="h-75 align-self-end" alt="">
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td class="pl-0">
                                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$konselor->nama_konselor}}</a>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$konselor->profesi_konselor}}</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button id="button__submit_case_conference" class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3" value="Kirim" type="submit">Kirim</button>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                </div>
                            <div class="card-body" id="step_3" style="display: none">
                                <div class="h1">3. Melakukan Case Conference</div>
                                <div class="text-muted mt-3 font-weight-bold font-size-sm ml-7">Case Conference telah bisa dilakukan dengan konselor yang dipilih.</div>
                                <div class="form-group ml-7 mt-7" >
                                    <label>Judul Case: </label>
                                    <input type="text" class="form-control" maxlength="25" id="input__judul_case"/>
                                    <span class="form-text text-muted"><span class="text-danger">*</span>tidak boleh lebih dari 25 karakter</span>
                                </div>
                                <div class="card-body py-3">
                                    <button id="button__masuk_case_conference" disabled class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3" value="Kirim" type="submit">Masuk ke conference</button>
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
    <script>
        $("#input__judul_case").keyup(function(){
            if($(this).val().length == 0){
                $('#button__masuk_case_conference').prop('disabled', true)
            }else{
                $('#button__masuk_case_conference').prop('disabled', false)
            }
        })
        $('#button__submit_case_conference').click(function(){
            $('#step-card-2').removeClass("bg-white")
            $('#step-card-2').addClass("bg-light")
            $('#step-card-3').removeClass("bg-light")
            $('#step-card-3').addClass("bg-white")
        })
    </script>
@endsection
