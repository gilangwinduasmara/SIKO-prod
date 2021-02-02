@php($konseli = $konseling->konseli)
<div id={{"personal_information__".$konseling->id}} style="display: none">
    <div class="card card-custom gutter-b" >
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none kt_app_chat_toggle" id="">
                        <span class="svg-icon svg-icon-lg">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo5/dist/assets/media/svg/icons/Communication/Adress-book2.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3"></path>
                                    <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </button>
                </span>
                <h3 class="card-label">Informasi Konseling
                {{-- <small>sub title</small></h3> --}}
            </div>

        </div>
        <div class="card-body">
            <div class="d-flex mb-9">
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <div class="symbol symbol-50 symbol-lg-120">
                        @if($user->role == 'konselor')
                        <img src={{"/avatars/".$konseli->user->avatar}} alt="image">
                        @else
                        <img src={{"/avatars/".$konseling->konselor->user->avatar}} alt="image">
                        @endif
                    </div>
                    <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                        <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                            @if($user->role=="konselor")
                            <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$konseli->nama_konseli}}</a>
                            @else
                            <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$konseling->konselor->nama_konselor}}</a>
                            @endif
                            @if($user->role=="konselor")
                            <a href="#">
                                <span>{{$konseling->jadwal->hari.", ".$konseling->jadwal->jam_mulai.":00 - ".$konseling->jadwal->jam_akhir.":00"}}</span>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between mt-1">
                        @if($user->role == 'konselor')
                        <div class="">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 mt-2">
                                    <div>
                                        <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->nim}}</div>
                                        <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->progdi}}</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 mt-2">
                                    <div>
                                        <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->jenis_kelamin}}</div>
                                        <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->tgl_lahir_konseli}}</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 mt-2">
                                    <div>
                                        <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{'Agama: '.$konseli->agama}}</div>
                                        <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{'Suku: '.$konseli->suku}}</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 mt-2">
                                    <div>
                                        <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{'No Hp Kerabat: '}}</div>
                                        <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->no_hp_kerabat." - $konseli->hubungan"}}</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 mt-2">
                                    <div>
                                        <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{'Alamat: '}}</div>
                                        <div href="#" class="text-dark-50 text-hover-primary font-weight-bold">{{$konseli->alamat_konseli}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div>
                            <div class="my-6">
                                <a href="#" class="text-dark-50 text-hover-primary font-size-sm font-weight-bold mr-3 my-8">{{$konseling->konselor->profesi_konselor}}</a><br>
                            </div>
                            <div class="my-8">
                                <a href="#" class="text-dark-50 text-hover-primary font-size-sm font-weight-bold mr-3">{{$konseling->konselor->user->email}}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @if ($konseling->status_konseling == "ref")
                @if($user->role == 'konselor')
                <button data-toggle="modal" data-target={{"#modal-pesan-rujukan__".$konseling->id}} class="btn btn-primary">Pesan Rujukan</button>
                @endif
                <div class="modal fade" id={{"modal-pesan-rujukan__".$konseling->id}} tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pesan Rujukan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body" style="height: 300px;">
                                <div class="form-group">
                                    <label>Oleh</label>
                                <input type="text" class="form-control"  readonly value="{{$konseling->referral->referred_from->konselor->nama_konselor}}"/>
                                </div>
                                <div class="form-group">
                                    <label>Pesan</label>
                                <textarea type="text" class="form-control" readonly>{{$konseling->referral->pesan_referral}}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="separator separator-solid my-8"></div>

            <div class="row d-flex align-items-center flex-wrap mt-8">
                <div class="col-xl-3 col-sm-2 my-2">
                    <button name={{"personal_information__ruangkonseling"}} konselingId="{{$konseling->id}}" {{$konseling->status_selesai != "C"?"disabled":""}} href="#" class="btn btn-primary btn-xs font-size-xs btn-shadow-hover font-weight-bolder w-100 py-3" {{$type == 'arsip' ? 'disabled' : ''}}>Ruang Konseling</button>
                </div>
                <div class="col-xl-3 col-sm-2 my-2">
                    <button name={{"personal_information__caseconference"}} {{$konseling->status_selesai != "C"?"disabled":""}} href={{"/setup/caseconference?id=".$konseling->id}} class="btn btn-primary btn-xs font-size-xs btn-shadow-hover font-weight-bolder w-100 py-3" {{$type == 'arsip' ? 'disabled' : ''}}>Case Conference</button>
                </div>
                <div class="col-xl-3 col-sm-2 my-2">
                    <button name={{"personal_information__referal"}} {{$konseling->status_selesai != "C"?"disabled":""}} href={{"/setup/referral?id=".$konseling->id}} class="btn btn-primary btn-xs font-size-xs btn-shadow-hover font-weight-bolder w-100 py-3" {{$type == 'arsip' ? 'disabled' : ''}}>Referal</button>
                </div>
                <div class="col-xl-3 col-sm-2 my-2">
                    <button {{$konseling->status_selesai == "C"?"disabled":""}} name={{"personal_information__rangkumankonseling"}} data-value={{$konseling->id}} href="#" class="btn btn-primary btn-xs font-size-xs btn-shadow-hover font-weight-bolder w-100 py-3">Rangkuman Konseling</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id={{"modal__rangkumankonseling_".$konseling->id}} tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <form class="modal-content" name="form__rangkumankonseling">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rangkuman Konseling</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="konseling_id" type="text" hidden value={{$konseling->id}}>
                    <div class="form-group">
                        <label>Rumusan Masalah Konseling <span class="text-danger">*</span></label>
                    <textarea name="rangkuman" type="text" class="form-control" rows="5"  required {{$type == 'arsip' ? 'readonly' : ''}}>@if ($type=='arsip'){{$konseling->rangkuman_konseling->rangkuman??''}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label>Treatment Yang Diberikan <span class="text-danger">*</span></label>
                    <textarea name="treatment" type="text" class="form-control"  rows="5" required {{$type == 'arsip' ? 'readonly' : ''}}>@if ($type=='arsip'){{$konseling->rangkuman_konseling->treatment??''}}@endif</textarea>
                    </div>
                </div>
                @if ($type == 'daftarkonseling')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary font-weight-bold" value="Simpan">
                    </div>
                @endif
            </form>
        </div>
    </div>
    @include('pages.widgets._history-konseling')
</div>

<script>
    // var konselings = @json($konseling);
</script>
