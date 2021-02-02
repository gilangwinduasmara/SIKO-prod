@extends('layout.default')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-6">
            <form class="card card-custom" id="form__admin_login">
                <div class="card-header">
                    <div class="card-title">Login sebagai admin</div>
                </div>
                <div class="card-body">
                    <input hidden name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input name="username" type="username" class="form-control"  placeholder="Username"/>
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control"  placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-warning" type="submit" class="form-control"  value="Login"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script>
        $('.header').hide();
        $('#form__admin_login').submit(function(e){
            toastr.options = conf.toastr.options.saving;
            toastr.info("Sedang memproses data")
            e.preventDefault();
            axios.post('/services/auth/login/admin', $(this).serialize()).then(res => {
                console.log(res.data)
                if(res.data.success){
                    window.location.href = "/admin"
                }else{
                    Object.keys(res.data.message).map((key, item) => {
                        toastr.error(res.data.message[key][0])
                    })
                }
            }).catch(err => {
                Object.keys(err.response.data.message).map((key, item) => {
                    toastr.error(err.response.data.message[key][0])
                })
            })
        })
    </script>
@endsection
