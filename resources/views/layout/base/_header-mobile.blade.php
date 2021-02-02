{{-- Header Mobile --}}
<div id="kt_header_mobile" class="header-mobile {{ Metronic::printClasses('header-mobile', false) }}" {{ Metronic::printAttrs('header-mobile') }}>
    <div class="mobile-logo">
        <button class="btn btn-icon aside-toggle ml-n3 mr-10" id="kt_aside_desktop_toggle">
            <span class="svg-icon svg-icon-xxl svg-icon-dark-75">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Align-left.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <rect fill="#000000" opacity="0.3" x="4" y="5" width="16" height="2" rx="1" />
                        <rect fill="#000000" opacity="0.3" x="4" y="13" width="16" height="2" rx="1" />
                        <path d="M5,9 L13,9 C13.5522847,9 14,9.44771525 14,10 C14,10.5522847 13.5522847,11 13,11 L5,11 C4.44771525,11 4,10.5522847 4,10 C4,9.44771525 4.44771525,9 5,9 Z M5,17 L13,17 C13.5522847,17 14,17.4477153 14,18 C14,18.5522847 13.5522847,19 13,19 L5,19 C4.44771525,19 4,18.5522847 4,18 C4,17.4477153 4.44771525,17 5,17 Z" fill="#000000" />
                    </g>
                </svg>

                <!--end::Svg Icon-->
            </span>
        </button>
        <a href="{{ url('/') }}">

            @php
                $kt_logo_image = 'logo-light.png'
            @endphp

            @if (config('layout.aside.self.display') == false)

                @if (config('layout.header.self.theme') === 'light')
                    @php $kt_logo_image = 'logo-dark.png' @endphp
                @elseif (config('layout.header.self.theme') === 'dark')
                    @php $kt_logo_image = 'logo-light.png' @endphp
                @endif

            @else

                @if (config('layout.brand.self.theme') === 'light')
                    @php $kt_logo_image = 'logo-dark.png' @endphp
                @elseif (config('layout.brand.self.theme') === 'dark')
                    @php $kt_logo_image = 'logo-light.png' @endphp
                @endif

            @endif

            <img alt="{{ config('app.name') }}" src="{{ asset('media/siko/logo.png') }}" style="height: 24px"/>
        </a>
    </div>
    <div class="topbar pr-8">
        @if(request()->is('/'))

        @endif
        @if (isset($user) )
            @if ($user->role != 'admin')
            <div class="dropdown">
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <i class="flaticon2-notification position-relative" >
                            <div name="notif-badge"  class="bg-danger p-2 rounded-lg position-absolute" style="top: -5px; right: -5px; display: none"></div>
                        </i>
                    </div>
                </div>
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right " >
                    <div class="clear-notif">
                        <a href="/notification/readall?type=notif" class="d-block navi-item bg-hover-light text-warning py-4 text-hover-warning">
                            <div class="navi-text text-center py-2 text-warning font-size-xs">
                                <span href="#" class="">Hapus Semua Notifikasi</span>
                                <span>
                                    <i class="far fa-trash-alt"></i>
                                </span>
                            </div>
                        </a>
                        <div class="separator separator-solid"></div>
                    </div>
                    <ul class="navi navi-hover py-4 " name="dropdown-notif" style="max-height: 300px; overflow-x: hidden">
                        <li class="navi-item">
                            <div class="navi-text">
                                <div class="font-weight-bold text-center">Belum ada notifikasi</div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="dropdown">
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <i class="flaticon-chat position-relative" >
                            <div name="chat-badge" class="bg-danger p-2 rounded-lg position-absolute" style="top: -5px; right: -5px; display: none"></div>
                        </i>
                    </div>
                </div>
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right " >
                    <div class="clear-chat">
                        <a href="/notification/readall?type=chat" class="d-block navi-item bg-hover-light text-warning py-4 text-hover-warning">
                            <div class="navi-text text-center py-2 text-warning font-size-xs">
                                <span href="#" class="">Hapus Semua Notifikasi</span>
                                <span>
                                    <i class="far fa-trash-alt text-warning"></i>
                                </span>
                            </div>
                        </a>
                        <div class="separator separator-solid"></div>
                    </div>
                    <ul class="navi navi-hover py-4 " name="dropdown-chat" style="max-height: 300px; overflow-x: hidden">
                        <li class="navi-item">
                            <div class="navi-text">
                                <div class="font-weight-bold text-center">Belum ada Notifikasi</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            <div class="dropdown">
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-dropdown w-auto btn-clean d-flex align-items-center btn-lg px-2">
                        <div class="symbol symbol-25">
                            <img class="img-fit" src={{"/avatars/".$user->avatar}} alt="image">
                        </div>
                    </div>
                </div>
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi navi-hover py-4">
                        @if ($user->role != 'konseli')
                            <li class="navi-item">
                                <a href="/gantipassword" class="navi-link">
                                    <div class="navi-text">
                                        <div class="font-weight-bold">Ganti Password</div>
                                    </div>
                                </a>
                            </li>
                            @else
                            <li class="navi-item">
                                <a href="/gantipin" class="navi-link">
                                    <div class="navi-text">
                                        <div class="font-weight-bold">Ganti Pin</div>
                                    </div>
                                </a>
                            </li>
                        @endif

                        <li class="navi-item">
                            <a href="/logout" class="navi-link">
                                <div class="navi-text">
                                    <div class="font-weight-bold">Logout</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <div class="topbar-item">
                    <div class="btn btn-icon btn-dropdown w-auto btn-clean d-flex align-items-center btn-lg px-2">
                        <button class="btn p-0 burger-icon rounded-0 burger-icon-left" id="kt_aside_tablet_and_mobile_toggle">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

        @endif

    </div>

</div>
