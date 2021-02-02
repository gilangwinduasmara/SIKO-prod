<!--begin::Chat-->
<div class="card card-custom" id="chat-container" style="display: none">
    <!--begin::Header-->
    <div class="card-header align-items-center px-4 py-3">
        <div class="text-left flex-grow-1">
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
            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" id="button__conference" aria-expanded="false">
                <span class="svg-icon svg-icon-lg">
                    <i class="fas fa-arrow-left"></i>
                </span>
            </button>
        </div>
        <div class="text-center flex-grow-1">
            <div class="text-dark-75 font-weight-bold font-size-h5" id="chat__username"></div>
            {{-- <div>
                <span class="label label-sm label-dot label-success"></span>
                <span class="font-weight-bold text-muted font-size-sm">Active</span>
            </div> --}}
        </div>
        <div class="text-right flex-grow-1">
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Scroll-->
        <div class="scroll scroll-pull" data-mobile-height="350" style="height: 165px; overflow: hidden;">
            <div class="container-fluid d-flex justify-content-center align-items-center">
                <div id="chat-spinner" class="spinner"></div>
            </div>
            <!--begin::Messages-->
            <div class="messages" id="messages-box">

            </div>
            <!--end::Messages-->
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 165px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 40px;"></div></div></div>
        <!--end::Scroll-->
    </div>
    <!--end::Body-->
    <!--begin::Footer-->
    <div class="card-footer align-items-center">
        <!--begin::Compose-->
        <textarea class="form-control border-0 p-0" rows="2" placeholder="Type a message"></textarea>
        <div class="d-flex align-items-center justify-content-between mt-5">
            {{-- <div class="mr-3">
                <a href="#" class="btn btn-clean btn-icon btn-md mr-1">
                    <i class="flaticon2-photograph icon-lg"></i>
                </a>
                <a href="#" class="btn btn-clean btn-icon btn-md">
                    <i class="flaticon2-photo-camera icon-lg"></i>
                </a>
            </div> --}}
            <div>
                <button type="button" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Send</button>
            </div>
        </div>
        <!--begin::Compose-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Chat-->
