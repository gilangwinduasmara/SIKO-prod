{{-- Topbar --}}
<div class="topbar pr-8">
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

    @endif

</div>
