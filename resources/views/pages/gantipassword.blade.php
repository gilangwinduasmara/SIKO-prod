{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}
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
        $(()=>{
            $('#form__gantipasword').submit(function(e){
                e.preventDefault();
                let error = false;
                $('.error').each(function(){
                    console.log($(this).text())
                    if($(this).text().trim().length > 0){
                        console.log('error')
                        error = true
                    }
                })

                if(error) {
                    return false
                }

                axios.post('/services/auth/changepassword', $(this).serialize()).then(res => {
                    Swal.fire({
                        text: "Password berhasil diubah",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-success"
                        }
                    });
                    return false
                }).catch(err => {
                    console.log(err)
                    Swal.fire({
                            title: "Ganti password gagal",
                            text: "Password yang anda masukkan salah!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                })
            })


            $('input[name="password"]').keyup(function(){
                console.log($(this).val())
                if($(this).val().length < 8){
                    $(this).next().text("Password harus minimal 8 karakter")
                }else{
                    $(this).next().text("")
                }
            })

            $('input[name="repeat"]').keyup(function(){
                console.log($(this).val())
                if($(this).val() != $('input[name="password"]').val()){
                    $(this).next().text("Konfirmasi password tidak sama dengan password baru")
                }else{
                    $(this).next().text("")
                }
            })

        })
    </script>
@endsection
