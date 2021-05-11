@extends('layout.default')

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
                <h3 class="card-title font-weight-bolder text-dark">Berkas</h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal__upload">
                        Unggah berkas
                    </button>
                </div>
            </div>
            <div class="card-body pt-2">
                @foreach ($konseling->files as $file)
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <div class="symbol symbol-60 symbol-2by3 symbol-success flex-shrink-0">
                            @if ($file->file_type == 'png')
                                <div class="symbol-label" style="background-image: url('{{$file->path}}')"></div>
                            @else
                                <span class="symbol-label font-size-h5">{{$file->file_type}}</span>
                            @endif
                        </div>
                        <div class="d-flex flex-column ml-4 flex-grow-1 mr-2">
                            <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">{{$file->name.'.'.$file->file_type}}</a>
                            <span class="text-muted font-weight-bold">Ukuran: {{$file->file_size/1000}} KB</span>
                        </div>
                        <a href="{{$file->path}}" download="{{$file->name.'.'.$file->file_type}}" class="btn btn-success">Unduh</a>
                    </div>
                @endforeach
            </div>
        </div>
     </div>
   </div>
   <div class="modal fade" id="modal__upload" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="exampleModalLabel">Unggah Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body" style="height: 300px;">
                    <div class="dropzone dropzone-default dropzone-success dz-clickable dz" >
                        <div class="dropzone-msg dz-message needsclick">
                            <h3 class="dropzone-msg-title">Seret berkas atau klik disini untuk mengunggah</h3>
                            <span class="dropzone-msg-desc">Only image, pdf and psd files are allowed for upload</span>
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
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
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
        $(document).ready(function(){
            const dz = new Dropzone('.dz', {
                url: "/services/file/upload", // Set the url for your upload script location
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: 1,
                maxFilesize: 5, // MB
                addRemoveLinks: true,
                accept: function(file, done) {
                    if (file.name == "justinbieber.jpg") {
                        done("Naha, you don't.");
                    } else {
                        done();
                    }
                }

            });
            dz.on("sending", function(file, xhr, formData) {
             formData.append("_token", CSRF_TOKEN);
            });
            dz.on("success", function(x, response) {
                console.log(response)
                $('[name="file_name"]').val(response.fileName.split('.')[0])
                $('[name="file_id"]').val(response.fileId)
                $('#form__confirm_upload').show()
            });
        })
    </script>
@endsection
