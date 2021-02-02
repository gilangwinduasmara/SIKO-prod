{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    @php($k = 's')
    {{-- Dashboard 1 --}}
    <div class="container">
        @if(count($caseconferences)==0)
        <div class="row w-100 justify-content-center align-items-center m-0 pt-24">
            <div class="row w-100 justify-content-center align-items-center m-0">
                <div class="col-sm-12 col-lg-6 ">
                    <div class="card border card-custom">
                        <div class="card-body">
                            <div class="text-center">
                                Belum ada case conference
                            </div>
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
                        <div class="mt-7">
                            <table id="table_list" data-marginless="true" style="display: none">
                                <thead>
                                    <tr><th></th></tr>
                                </thead>
                                <tbody>
                                    @foreach ($caseconferences as $key=>$case)
                                    <tr>
                                        <td class="mt-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                @php($detailConferences = json_decode(json_encode($case))->detail_conferences)
                                                <a class="card card-custom flex-grow-1 bg-hover-light" href="#" name="konselor_list_item" data-value={{$case->id}} >
                                                    <div class="card-body d-flex align-items-center py-2">
                                                        <div class="d-flex flex-column">
                                                            <div class="text-muted">{{\Carbon\Carbon::parse($case->created_at)->format("d/m/Y H:i:s")}}</div>
                                                            <div class="text-dark text-hover-primary mb-1 font-size-lg">{{ $case->judul_case_conference }}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="separator separator-solid m-0"></div>
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
                @if(count($caseconferences)>0)
                @include('pages.widgets._conference-information')
                @include('pages.widgets.chat._chat-group')
                @endif
            </div>
            <!--end::Content-->
        </div>
        @endif
        <!--begin::Chat-->

        <!--end::Chat-->
    </div>

    <div class="modal fade" id="modal__profile_konseli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informasi Konseli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner spinner-modal-profile"></div>
                    </div>
                    <div class="card card-custom card-stretch gutter-b card-shadowless bg-light mt-8 profile-konseli" >
                        <div class="card-body py-3">
                            <div class="card-body">
                                <div class="d-flex mb-9 justify-content-center">
                                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                        <div class="symbol symbol-50 symbol-lg-120">
                                            <img src={{"/avatars/default.jpg"}} alt="image" id="popup__avatar">
                                        </div>
                                        <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                            <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="d-flex justify-content-between flex-wrap mt-1">
                                            <div class="d-flex mr-3">
                                                <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3" id="popup__nama"></a>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap justify-content-between mt-1">
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-sm-3 col-lg-3 mt-4">
                                                        <div>
                                                            <div href="#" class="text-dark-50 text-hover-primary font-weight-bold" id="popup__nim"></div>
                                                            <div href="#" class="text-dark-50 text-hover-primary font-weight-bold" id="popup__progdi"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-lg-3 mt-4">
                                                        <div>
                                                            <div href="#" class="text-dark-50 text-hover-primary font-weight-bold" id="popup__jenis_kelamin"></div>
                                                            <div href="#" class="text-dark-50 text-hover-primary font-weight-bold" id="popup__tgl_lahir"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-lg-3 mt-4">
                                                        <div>
                                                            <div href="#" class="text-dark-50 text-hover-primary font-weight-bold" id="popup__agama"></div>
                                                            <div href="#" class="text-dark-50 text-hover-primary font-weight-bold" id="popup__suku"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-lg-3 mt-4">
                                                        <div>
                                                            <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{'Alamat: '}}</div>
                                                            <div href="#" class="text-dark-50 text-hover-primary font-weight-bold" id="popup__alamat"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal__tambahkonselor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Konselor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-custom card-stretch gutter-b card-shadowless bg-light mt-8">
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                                    <thead>
                                        <tr class="text-left">
                                            <th class="pl-0" style="width: 20px">
                                                <label class="checkbox checkbox-lg checkbox-inline">
                                                    <input type="checkbox" value="0">
                                                    <span></span>
                                                </label>
                                            </th>
                                            <th class="pr-0" style="width: 50px">Konselor</th>
                                            <th style="min-width: 200px"></th>
                                            <th style="min-width: 150px">Profesi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list__tambahkonselor">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button id="button__tambahkonselor_submit" type="button" class="btn btn-primary font-weight-bold">Tambahkan Konselor</button>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        var caseconferences = @json($caseconferences);
        var user = @json($user);
        var konselors = @json($konselors);
        var selectedCaseconference = null;
        // var selectedCaseconference = caseconferences[0];
    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/chat/chat.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/list.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/caseconferenceinformation.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/chatgroup.js') }}" type="text/javascript"></script>

@endsection
