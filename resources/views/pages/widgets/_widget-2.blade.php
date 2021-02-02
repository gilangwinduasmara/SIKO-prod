{{-- List Widget 9 --}}

<div class="card card-custom border {{ @$class }}">
    {{-- Header --}}
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="font-weight-bolder text-dark">Daftar Konseling</span>
            {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">890,344 Sales</span> --}}
        </h3>
        <div class="card-toolbar">
            <div class="dropdown dropdown-inline">
                <a href="#" class="btn btn-light-warning btn-sm font-weight-bolder dropdown-toggle dropdown-daftarkonseling" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Senin</a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover">
                        {{-- <li class="navi-header pb-1">
                            <span class="text-primary text-uppercase font-weight-bold font-size-sm">Add new:</span>
                        </li> --}}
                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                            <li class="navi-item">
                                <a href="#" class="navi-link" id={{"daftarkonseling__hari_".$hari}}>
                                    <span class="navi-text">{{$hari}}</span>
                                    @if (isset($daftarkonseling[$hari]))
                                        <span class="navi-label">
                                            <span class="label label-primary label-rounded font-weight-bold"></span>
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!--end::Navigation-->
                </div>
            </div>
        </div>
    </div>

    <div class="card-body pt-4">
        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
            <div class="timeline  mt-3" id={{"jadwal__".$hari}} style="display: none">
                @if (isset($daftarkonseling[$hari]))
                    @foreach ($daftarkonseling[$hari] as $jadwal)
                        <div class="d-flex align-items-start">
                            <div class=" font-weight-bolder text-dark-75 font-size-lg" style="">{{$jadwal->jadwal->jam_mulai.":00 - ".$jadwal->jadwal->jam_akhir.":00"}}</div>
                            <span class="font-weight-bolder text-dark-75 pl-3 font-size-lg">{{$jadwal->konseli->nama_konseli}}</span>
                        </div>
                    @endforeach
                @else
                <div class="d-flex align-items-start justify-content-center">
                    Tidak ada jadwal konseling
                </div>
                @endif
            </div>
        @endforeach

    </div>
</div>
