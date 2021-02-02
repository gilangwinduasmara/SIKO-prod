{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    @php($k = 's')
    {{-- Dashboard 1 --}}
    <div class="container">
        <!--begin::Chat-->

        <div class="card card-custom bg-gray-100 gutter-b card-stretch card-shadowless">
            <div class="card-header h-auto border-0">
                <div class="card-title py-5">
                    <h3 class="card-label">
                        <span class="d-block text-dark font-weight-bolder">Persetujuan Referral (Langkah Terakhir)</span>
                        <span class="d-block text-dark-50 mt-2 font-size-sm">Berdasarkan persetujuan yang Anda berikan sebelumnya, Konselor Anda memilihkan Konselor lain dan jadwal yang mungkin untuk Anda melakukan konseling. Silahkan disetujui. Anda dimungkinkan untuk mengganti jadwal jika tersedia jadwal kosong.</span>
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column">
                    <div class="flex-row-fluid ml-lg-8">
                        <div class="card card-custom card-light row">
                            <div class="card-body d-flex align-items-center">
                                <div class="symbol symbol-75">
                                    <img class="img-fit" src={{"avatars/".$konselor->user->avatar}} alt="">
                                </div>
                                <div class="ml-8">
                                    <div class="text-dark-75 font-weight-bold font-size-h5">{{$konselor->nama_konselor}}</div>
                                    <div class="text-dark-50 font-weight-bold">{{"Profesi: ".$konselor->profesi_konselor}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-row-fluid ml-lg-8 mt-8">
                        @include(
                            'pages.widgets._konselor-selector',
                            ["title" => "Persetujuan Referral"],
                            [
                                "submit" =>
                                [
                                    "button_title" => "Setujui Referral",
                                    "form_id" => "form__ganti_jadwal"
                                ]
                            ]
                            )
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        var konselors = [@json($konselor)];
        var konseling = @json($konseling);
        {{--var konselings = @json($konselings);--}}
        {{--var selectedKonselingDetail = konselings[0];--}}
        {{--var selectedKonseling = konselings[0].id;--}}

    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/chat/chat.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/list.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/personalinformation.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/src/konselorselector.js')}}"></script>
    <script>

        jadwalKonselor = @json($jadwals);
        Object.keys(jadwalKonselor).map((hari, index) => {
            $('#day_item__'+hari).attr('data-toggle', 'pill');
            $($('#day_item__'+hari).children()[0]).addClass('text-dark');

        });

        $(document).ready(function(){
            $('#day_item__'+konseling.jadwal.hari).click();
            $(`li[data-value="${konseling.jadwal.id}"] a`).click();
            $('#form__ganti_jadwal').submit(function(e){
                e.preventDefault();
            })
            $('.empty-state').hide()
            $('#chat-container').show()
        })

        $('#form__ganti_jadwal').submit(function(e){
            e.preventDefault();
            toastr.options = conf.toastr.options.saving
            toastr.info("", "Memproses data");
            axios.post('/services/referral/begin', $(this).serialize()).then(res=>{
                toastr.clear();
                if(res.data.success){
                    window.location.href="/ruangkonseling"
                }else{
                    Swal.fire({
                        title: '',
                        text: res.data.error
                    }).then(function(result){
                        if(result.value){
                            if(res.data.redirect){
                                window.location.reload();
                            }
                        }
                    })
                }
            })
        })
    </script>
@endsection

