{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            @if(request()->submenu == 'expiration')
            @include('pages.admin._setting-expiration')
            @else
            @include('pages.admin._setting-maxkonseli')
            @endif
        </div>
    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/src/session.js')}}"></script>
    <script>
        $(document).ready(function(){
            function submitSetting(data){
                toastr.options = conf.toastr.options.saving;
                toastr.info("Sedang memproses data")

                axios.post('/services/setting', data).then(res => {
                    console.log(res.data)
                    window.location.reload();
                })
            }
            $('#form__expiration').submit(function(e){
                e.preventDefault()
                submitSetting($(this).serialize())
            })
            $('#form__maxkonseli').submit(function(e){
                e.preventDefault()
                submitSetting($(this).serialize())
            })
        })
    </script>
@endsection
