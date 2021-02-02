{{-- Header --}}
<div id="kt_header" class="header {{ Metronic::printClasses('header', false) }}" {{ Metronic::printAttrs('header') }}>
    <div id="kt_header" class="header header-fixed">

        <!--begin::Container-->
        <div class="container d-flex align-items-stretch justify-content-between">

            <div class="d-none d-lg-flex align-items-center mr-3">
                <button class="btn btn-icon aside-toggle ml-n3 mr-10" id="toggle_menu">
                    <span class="svg-icon svg-icon-xxl svg-icon-dark-75">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect fill="#000000" opacity="0.3" x="4" y="5" width="16" height="2" rx="1" />
                                <rect fill="#000000" opacity="0.3" x="4" y="13" width="16" height="2" rx="1" />
                                <path d="M5,9 L13,9 C13.5522847,9 14,9.44771525 14,10 C14,10.5522847 13.5522847,11 13,11 L5,11 C4.44771525,11 4,10.5522847 4,10 C4,9.44771525 4.44771525,9 5,9 Z M5,17 L13,17 C13.5522847,17 14,17.4477153 14,18 C14,18.5522847 13.5522847,19 13,19 L5,19 C4.44771525,19 4,18.5522847 4,18 C4,17.4477153 4.44771525,17 5,17 Z" fill="#000000" />
                            </g>
                        </svg>
                    </span>
                </button>

                <a href="/">
                    <img alt="Logo" src="/media/siko/logo.png" class="logo-sticky max-h-35px" />
                </a>
            </div>
        </div>

        @include('layout.partials.extras._topbar')
    </div>

</div>
