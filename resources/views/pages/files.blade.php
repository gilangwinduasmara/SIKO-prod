@extends('layout.default')

@section('content')
    {{$konseling}}
   <div class="row justify-content-center py-8">
       <div class="col-xl-6">
           <div class="card card-custom border">
               <div class="card-header">
                   <div class="card-title">
                       <div class="text-size-h4">
                            Ganti Password
                       </div>
                   </div>
               </div>
               <form class="card-body" id="form__gantipasword">
                   <div class="form-group">
                       <label>Password lama</label>
                       <input name="password_lama" type="password" required class="form-control">
                       <span class="text-danger error"></span>
                   </div>
                   <div class="form-group">
                       <label>Password baru</label>
                       <input name="password" type="password" required class="form-control">
                       <span class="text-danger error"></span>
                   </div>
                   <div class="form-group">
                       <label>Konfirmasi password</label>
                       <input name="repeat" type="password" required class="form-control">
                       <span class="text-danger error"></span>
                   </div>
                   <input type="submit" class="btn btn-warning" value="Simpan">
                </form>
           </div>
       </div>
   </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/src/app.js')}}"></script>
    <script>
    </script>
@endsection
