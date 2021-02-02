{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

    <div class="row">
        <div class="col-lg-6 col-xxl-6">
            <div class="card border card-custom p-8 ">
                <div class="d-flex align-items-center rounded-top">
                    {{-- Symbol --}}
                    <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
                        <img src={{"/avatars/".$user->avatar}} alt="" style="object-fit: cover"/>
                    </div>

                    {{-- Text --}}
                    <div class="flex-grow-1">
                    <div class="text-dark m-0 mr-3 font-size-h5">{{$user->details->nama_konselor}}</div>
                        <div class="text-muted">{{$user->details->profesi_konselor}}</div>
                    </div>
                    <a href="/profile"><span class="btn btn-clean btn-hover-light-warning btn-sm btn-icon"><i class="fas fa-pen"></i></span></a>
                </div>
                <div class="py-9">
                    <div class="d-flex align-items-center mb-2">
                        <span class="font-weight-bold mr-2">Email:</span>
                        <a href="#" class="text-muted text-hover-primary">{{$user->email}}</a>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="font-weight-bold mr-2">Phone:</span>
                        <span class="text-muted">{{$user->details->no_hp_konselor}}</span>
                    </div>
                </div>
            </div>
            {{-- {{$user}} --}}
            {{-- @include('pages.widgets._widget-1', ['class' => 'card-stretch gutter-b']) --}}
        </div>

        <div class="col-lg-6 col-xxl-4">
            {{-- Daftar Konseling --}}
            @include('pages.widgets._widget-2', ['class' => 'card-stretch gutter-b'])
        </div>
    </div>
    <div class="row mt-8">
        <div class="col-lg-6 col-xxl-6">
            <div class="card border card-custom">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                            <div>Konseling Aktif</div>
                            <div class="text-warning font-weight-bold font-size-h1">{{$statistik['aktif']['total']}}</div>
                        </div>
                        <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                            <div>Baru</div>
                            <div class="text-danger font-weight-bold font-size-h1">{{$statistik['aktif']['baru']}}</div>
                        </div>
                        <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                            <div>Referal</div>
                            <div class="text-info font-weight-bold font-size-h1">{{$statistik['aktif']['referral']}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border card-custom my-8">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                            <div class="text-center">Konseling Selesai</div>
                            <div class="text-warning font-weight-bold font-size-h1">{{$statistik['selesai']['total']}}</div>
                        </div>
                        <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                            <div>Case Closed</div>
                            <div class="text-success font-weight-bold font-size-h1">{{$statistik['selesai']['cc']}}</div>
                        </div>
                        <div class="col-2 d-flex flex-column justify-content-center align-items-center">
                            <div class="text-center">Referred</div>
                            <div class="text-primary font-weight-bold font-size-h1">{{$statistik['selesai']['r']}}</div>
                        </div>
                        <div class="col-2 d-flex flex-column justify-content-center align-items-center">
                            <div class="text-center">Expired</div>
                            <div class="text-danger font-weight-bold font-size-h1">{{$statistik['selesai']['e']}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xxl-4">
            <div class="card border card-custom">
                <div class="card-body">
                    <div cla
                    ss="row d-flex justify-content-center align-items-center h-200px">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="text-center">Case Conference</div>
                            <div class="text-warning font-weight-bold font-size-h1">{{$statistik['count']['total_conference']}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/session.js') }}" type="text/javascript"></script>
@endsection
