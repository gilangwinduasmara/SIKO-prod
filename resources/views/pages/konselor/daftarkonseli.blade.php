{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    @php($k = 's')
    {{-- Dashboard 1 --}}
    <div class="container">
        <!--begin::Chat-->
        @if(count($konselings) == 0)
            <div class="row w-100 justify-content-center align-items-center m-0 pt-24">
                <div class="col-sm-12 col-lg-6 ">
                    <div class="card border card-custom">
                        <div class="card-body">
                            <div class="text-center">
                                Belum ada sesi konseling
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px" id="kt_chat_aside">
                    <!--begin::Card-->
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
                            <div id="konseli-wrapper" class="mt-7">
                                <table id="table_list">
                                    <thead>
                                        <tr><th></th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($konselings as $konseling)
                                            @php ($konseling = json_decode(json_encode($konseling)))
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-end flex-column justify-content-between mb-5">
                                                        <div class="d-flex w-100 justify-content-between align-items-center">

                                                                @if($type == 'arsip')
                                                                    @if($konseling->refered!="ya")
                                                                    <div class="text-muted">{{\Carbon\Carbon::parse($konseling->rangkuman_konseling->created_at)->format('d/m/Y H:i:s')}}</div>
                                                                    @else
                                                                    <div class="text-muted">{{\Carbon\Carbon::parse($konseling->updated_at)->format('d/m/Y H:i:s')}}</div>
                                                                    @endif
                                                                    <div>
                                                                        @if($konseling->refered == 'ya')
                                                                            <span class="label label-lg label-light-primary label-inline">
                                                                                Referred
                                                                            </span>
                                                                        @else
                                                                            <span class="label label-lg label-light-success label-inline">
                                                                                Case Close
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                <div class="text-muted">{{\Carbon\Carbon::parse($konseling->created_at)->format('d/m/Y H:i:s')}}</div>
                                                                    <div>
                                                                        @if($konseling->status_selesai == "E" && $type != 'arsip')
                                                                        <span class="label label-lg label-light-primary label-inline">
                                                                            Case Close
                                                                        </span>
                                                                        @else
                                                                        @if($konseling->status_selesai == "expired")
                                                                        <span class="label label-lg label-light-danger label-inline">
                                                                            Expired
                                                                        </span>
                                                                        @else
                                                                        @if($konseling->status_konseling == 'ref')
                                                                        <span class="label label-lg label-light-success label-inline">
                                                                            Ref
                                                                        </span>
                                                                        @else
                                                                        <span class="label label-lg label-light-info label-inline">
                                                                            Baru
                                                                        </span>
                                                                        @endif
                                                                        @endif
                                                                        @endif
                                                                    </div>
                                                                @endif

                                                        </div>
                                                        <div class="d-flex align-items-center w-100">
                                                            <div class="symbol symbol-circle symbol-50 mr-3">
                                                                <img alt="Pic" src={{"/avatars/".$konseling->konseli->user->avatar}}>
                                                            </div>
                                                            <div class="d-flex flex-column w-100">
                                                                <a id={{"daftarkonseli__".$konseling->id}} href="#" style="max-width: 70%" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg text-truncate" >{{substr($konseling->konseli->nama_konseli, 0,25)}}</a>
                                                                <div class="d-flex justify-content-between flex-grow-1">
                                                                    @if($type != 'arsip')
                                                                        @if (count($konseling->chats) > 0)
                                                                            <div class="text-muted font-weight-bold font-size-sm text-truncate w-50">{{ substr(base64_decode($konseling->chats[0]->chat_konseling), 0,20) }}</div>
                                                                        @endif
                                                                        @if($konseling->chats)
                                                                        <span class="text-muted font-weight-bold font-size-sm">{{\Carbon\Carbon::parse($konseling->chats[0]->created_at)->diffForHumans(null, true)}}</span>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column align-items-end">

                                                        </div>
                                                    </div>
                                                    <div class="separator separator-solid mt-5">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 12px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: -28px; height: 40px;"></div></div></div>
                            <!--end:Users-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8" id="kt_chat_content">
                    @include('pages.widgets.chat._chat-private')
                    <div class="empty-state h-100">
                        <div class="card card-custom gutter-b" >
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="card-icon">
                                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none kt_app_chat_toggle" id="">
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
                                    </span>
                                    <h3 class="card-label">Informasi Konseling
                                    {{-- <small>sub title</small></h3> --}}
                                </div>
                            </div>
                            <div class="card-body h-100">

                            </div>
                        </div>
                    </div>
                    @foreach ($konselings as $konseling)
                        @php ($konseling = json_decode(json_encode($konseling)))
                        @include('pages.widgets._personal-information')
                    @endforeach
                </div>
                <!--end::Content-->
            </div>
        @endif

        <!--end::Chat-->
    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        var konselings = @json($konselings);
        var user = @json($user);
        var selectedKonselingDetail = null;
        var selectedKonseling = null;
        // var selectedKonselingDetail = konselings[0];
        // var selectedKonseling = selectedKonselingDetail.id;

    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/chat/chat.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/list.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/personalinformation.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/chat.js') }}" type="text/javascript"></script>
@endsection
