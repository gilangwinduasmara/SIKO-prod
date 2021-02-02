@php($days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'])
<!--begin::Chat-->
<div class="empty-state h-100">
    <div class="card card-custom row h-100" >
        <!--begin::Header-->
        <div class="card-header align-items-center px-4 py-3">
            <div class="text-left flex-grow-1">
                <!--begin::Aside Mobile Toggle-->
                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none " id="kt_app_chat_toggle">
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
                <!--end::Aside Mobile Toggle-->

                <!--begin::Dropdown Menu-->

                <!--end::Dropdown Menu-->
            </div>
            <div class="text-center flex-grow-1">
                <div class="text-dark-75 font-weight-bold font-size-h5" id="chat__username">{{$title ?? "Daftar Sesi Konseling"}}</div>
                {{-- <div>
                    <span class="label label-sm label-dot label-success"></span>
                    <span class="font-weight-bold text-muted font-size-sm">Active</span>
                </div> --}}
            </div>
            <div class="text-right flex-grow-1">
                <!--begin::Dropdown Menu-->

                <!--end::Dropdown Menu-->
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body">

        </div>
    </div>
</div>
<div class="card card-custom row" id="chat-container" style="display: none">
    <!--begin::Header-->
    <div class="card-header align-items-center px-4 py-3">
        <div class="text-left flex-grow-1">
            <!--begin::Aside Mobile Toggle-->
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

            <!--end::Aside Mobile Toggle-->

            <!--begin::Dropdown Menu-->

            <!--end::Dropdown Menu-->
        </div>
        <div class="text-center flex-grow-1">
            <div class="text-dark-75 font-weight-bold font-size-h5" id="chat__username">{{$title ?? "Daftar Sesi Konseling"}}</div>
            <span class="font-weight-bold text-muted font-size-sm" id="selected_konselor"></span>
            {{-- <div>
                <span class="label label-sm label-dot label-success"></span>
                <span class="font-weight-bold text-muted font-size-sm">Active</span>
            </div> --}}
        </div>
        <div class="text-right flex-grow-1">
            <!--begin::Dropdown Menu-->

            <!--end::Dropdown Menu-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <div class="text-center mb-10">Pilih jadwal Konselor yang tersedia</div>

        <div class="row">
            <div class="col">
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-body p-0">
                        <ul class="dashboard-tabs nav nav-pills nav-warning row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
                            @foreach($days as $day)
                            <li id={{"list_hari__".ucwords($day)}} class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                                <a id={{"day_item__".ucwords($day)}} class="nav-link py-3 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="" data-value={{ucwords($day)}} >
                                    <span class="font-size-lg py-2 font-weight-bold text-center">{{ucwords($day)}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content m-0 p-0">
                            <div class="tab-pane active" id="forms_widget_tab_1" role="tabpanel"></div>
                            <div class="tab-pane" id="forms_widget_tab_2" role="tabpanel"></div>
                            <div class="tab-pane" id="forms_widget_tab_3" role="tabpanel"></div>
                            <div class="tab-pane" id="forms_widget_tab_4" role="tabpanel"></div>
                            <div class="tab-pane" id="forms_widget_tab_6" role="tabpanel"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-3" id="jadwal">
            <ul class="dashboard-tabs nav nav-pills nav-warning row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist" id="ul__days_selector">

            </ul>
        </div>
        </div>
        <form class="row d-flex justify-content-center align-items-center" id={{$submit['form_id']??"form_daftar_sesi"}}>
            <input id="input__konselor_id" type="text" hidden name="konselor_id">
            <input id="input__jadwal_konselor_id" type="text" hidden name="jadwal_konselor_id">

            <div class="col-sm-2">
                <button type="submit" id="button__daftar_sesi" href="/daftarsesi" class="btn btn-warning btn-shadow-hover font-weight-bolder w-100 py-3" disabled>
                    {{$submit['button_title']??"Daftar Sesi"}}
                </button>
            </div>
        </form>
    </div>
</div>
<!--end::Chat-->
