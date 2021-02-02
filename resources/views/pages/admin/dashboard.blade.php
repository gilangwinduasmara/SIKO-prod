{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-xxl-6 mb-8">
            <div class="card border card-custom p-8 d-flex flex-column justify-content-center align-items-center">
                <div>
                    Konselor
                </div>
                <div class="display-2 font-weight-bolder text-warning">
                    {{$stat['count']['total_konseling']}}
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xxl-6 mb-8">
            <div class="card border card-custom p-8 d-flex flex-column justify-content-center align-items-center">
                <div>
                    Case Conference
                </div>
                <div class="display-2 font-weight-bolder text-warning">
                    {{$stat['count']['total_conference']}}
                </div>
            </div>
        </div>
        <div class="col-xxl-12">
            <div class="card border card-custom p-8">
                <div class="row align-items-items justify-content-center">
                    <div class="col-lg-4 col-xxl-4 p-8 d-flex flex-column justify-content-center align-items-center">
                        <div>
                            Konseling Aktif
                        </div>
                        <div class="display-2 font-weight-bolder text-warning">
                            {{$stat['aktif']['baru']+$stat['aktif']['referral']}}
                        </div>
                    </div>
                    <div class="col-lg-4 col-xxl-4 p-8 d-flex flex-column justify-content-center align-items-center">
                        <div>
                            Baru
                        </div>
                        <div class="display-2 font-weight-bolder text-warning">
                            {{$stat['aktif']['baru']}}
                        </div>
                    </div>

                    <div class="col-lg-4 col-xxl-4 p-8 d-flex flex-column justify-content-center align-items-center">
                        <div>
                            Referral
                        </div>
                        <div class="display-2 font-weight-bolder text-warning">
                            {{$stat['aktif']['referral']}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xxl-12 mt-8">
            <div class="card border card-custom p-8">
                <div class="row align-items-items justify-content-center">
                    <div class="col-lg-3 col-xxl-3 p-8 d-flex flex-column justify-content-center align-items-center">
                        <div>
                            Konseling Selesai
                        </div>
                        <div class="display-2 font-weight-bolder text-warning">
                            {{$stat['selesai']['cc']+$stat['selesai']['r']+$stat['selesai']['e']}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-xxl-3 p-8 d-flex flex-column justify-content-center align-items-center">
                        <div>
                            Case Closed
                        </div>
                        <div class="display-2 font-weight-bolder text-warning">
                            {{$stat['selesai']['cc']}}
                        </div>
                    </div>

                    <div class="col-lg-3 col-xxl-3 p-8 d-flex flex-column justify-content-center align-items-center">
                        <div>
                            Referred
                        </div>
                        <div class="display-2 font-weight-bolder text-warning">
                            {{$stat['selesai']['r']}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-xxl-3 p-8 d-flex flex-column justify-content-center align-items-center">
                        <div>
                            Expired
                        </div>
                        <div class="display-2 font-weight-bolder text-warning">
                            {{$stat['selesai']['e']}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row mt-8">

    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/src/session.js')}}"></script>
@endsection
