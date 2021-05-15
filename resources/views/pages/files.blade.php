@extends('layout.default')
@php
    $imageExtensions = array("jpeg","jpg","png", "gif", "svg");
@endphp
@section('content')
   <div class="row justify-content-center py-8">
       {{-- <div class="col-xl-10">
            <div class="dropzone dropzone-default dropzone-success dz-clickable dz" >
                <div class="dropzone-msg dz-message needsclick">
                    <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                    <span class="dropzone-msg-desc">Only image, pdf and psd files are allowed for upload</span>
                </div>
            </div>
       </div> --}}
     <div class="col-xl-10">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-header border-0">

                <h3 class="card-title font-weight-bolder text-dark">
                    @if ($user->role == 'konselor')
                        <a type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" aria-expanded="false" href="/daftarkonseli?id={{$konseling->id}}" data-toggle="tooltip" title="Kembali ke Daftar Konseling">
                            <span class="svg-icon svg-icon-lg">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo5/dist/assets/media/svg/icons/Communication/Add-user.svg-->
                                <i class="fas fa-arrow-left"></i>
                                <!--end::Svg Icon-->
                            </span>
                        </a>
                    @endif
                    Berkas</h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal__upload">
                        Unggah berkas
                    </button>
                </div>
            </div>
            <div class="card-body pt-2">
                @if (count($konseling->files) == 0)
                    <div class="text-center">Berkas masih kosong</div>
                @else
                    @foreach ($konseling->files as $file)
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <div class="symbol symbol-60 symbol-2by3 symbol-success flex-shrink-0">
                                @if (in_array(strtolower($file->file_type), $imageExtensions))
                                    <div class="symbol-label" style="background-image: url('{{$file->path}}')"></div>
                                @else
                                    <span class="symbol-label font-size-h5">{{$file->file_type}}</span>
                                @endif
                            </div>
                            <div class="d-flex flex-column ml-4 flex-grow-1 mr-2">
                                <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">{{$file->uploaded_by}}</a>
                                <a href="#" class="text-dark-50 font-weight-bold text-hover-primary font-size-lg mb-1">{{$file->name.'.'.$file->file_type}}</a>
                                <span class="text-muted font-weight-bold">{{ \Carbon\Carbon::parse($file->created_at)->diffForhumans() }} &bull; {{$file->file_size/1000}} KB</span>
                            </div>
                            <div class="d-flex flex-grow-1 justify-content-end">
                                @if ($user->id == $file->user->id)
                                    <div>
                                        <a href="{{$file->path}}" download="{{$file->name.'.'.$file->file_type}}" class="btn btn-warning">Edit</a>
                                    </div>
                                    <div class="mx-4">
                                        <a href="{{$file->path}}" download="{{$file->name.'.'.$file->file_type}}" style="background: #f64d60; border-color: #f64d60" class="btn btn-danger">Hapus</a>
                                    </div>
                                @endif
                                <div>
                                    <a href="{{$file->path}}" download="{{$file->name.'.'.$file->file_type}}" class="btn btn-success">Unduh</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
     </div>
   </div>
   <div class="modal fade" id="modal__upload" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog bd-example-modal-lgbd-example-modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="exampleModalLabel">Unggah Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body" >
                    <div class="dropzone dropzone-default dropzone-success dz-clickable dz" >
                        <div class="dropzone-msg dz-message needsclick">
                            <h3 class="dropzone-msg-title">Seret berkas atau klik disini untuk mengunggah</h3>
                            <span class="dropzone-msg-desc">Maksimal ukuran file: 2 MB (jpeg, jpg, png, pdf, gif, svg)</span>
                        </div>
                    </div>
                    <form id="form__confirm_upload" action="/services/file" method="POST" style="display: none">
                        @csrf
                        <input name="konseling_id" type="text" class="form-control" value="{{$konseling->id}}" hidden>
                        <input name="user_id" type="text" class="form-control" value="{{$user->id}}" hidden>
                        <input name="file_id" type="text" class="form-control" value="" hidden>
                        <div class="form-group mt-8">
                            <label for="">Nama file</label>
                            <input name="file_name" type="text" class="form-control" value="">
                        </div>
                        <button id="button__upload" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                </div>
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
        var CSRF_TOKEN = "{{ csrf_token() }}"
        let dz = null;
        $(document).ready(function(){
            dz = new Dropzone('.dz', {
                url: "/services/file/upload", // Set the url for your upload script location
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: 1,
                maxFilesize: 2, // MB
                addRemoveLinks: true,
                acceptedFiles: 'image/*, application/pdf',
                accept: function(file, done) {
                    if (file.name == "justinbieber.jpg") {
                        done("Naha, you don't.");
                    } else {
                        done();
                    }
                },
                init: function() {
                    this.on("maxfilesexceeded", function(file) {
                            this.removeAllFiles();
                            this.addFile(file);
                    });
                    this.on('error', function(file, errorMessage) {
                        $('#form__confirm_upload').hide()
                        if (errorMessage.indexOf('File is too big') !== -1) {
                            this.removeAllFiles();
                            Swal.fire("Terjadi kesalahan", "Ukuran file terlalu besar", "error");
                        }
                    });
                }
            });
            dz.on("sending", function(file, xhr, formData) {
                formData.append("_token", CSRF_TOKEN);
            });
            dz.on("success", function(x, response) {
                console.log(response)
                if(response.success){
                    $('[name="file_name"]').val(response.fileName.split('.')[0])
                    $('[name="file_id"]').val(response.fileId)
                    $('#form__confirm_upload').show()
                }else{
                    Swal.fire("Terjadi kesalahan", response.error, "error")
                    $('#form__confirm_upload').hide()
                    dz.removeAllFiles()
                    $('#button__upload').attr('disabled', false)
                }
            });
            $('#button__upload').click(function(event){
                if($('[name="file_name"]').val().length == 0){
                    Swal.fire("Terjadi kesalahan", "Nama file harus diisi", "error");
                    event.preventDefault();
                    return;
                }
                $('#button__upload').attr('disabled', true)
                $('#form__confirm_upload').submit();
            });
        })
    </script>
@endsection
