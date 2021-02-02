{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <form class="col-lg-3 mb-4" id="form-personal">
                                <h3 class="card-label">
                                    <span class="d-block text-dark font-weight-bolder">Informasi Personal</span>
                                </h3>
                                <div class="form-group">
                                    <label>Nama <span class="text-danger">*</span></label>
                                    <input value="{{$user->details->nama_konselor}}" name="nama" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>Profesi <span class="text-danger">*</span></label>
                                    <input value="{{$user->details->profesi_konselor}}" name="profesi" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>No. HP <span class="text-danger">*</span></label>
                                    <input name="nohp" value="{{$user->details->no_hp_konselor}}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input value="{{$user->email}}" name="email" type="email" class="form-control"  placeholder="Enter email"/>
                                </div>
                            </form>
                            <div class="col-lg-6">
                                <h3 class="card-label">
                                    <span class="d-block text-dark font-weight-bolder">Jadwal Online</span>
                                </h3>
                                <div>
                                    <div class="row" id="jadwal-container">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleSelectd">Hari</label>
                                                <select class="form-control" id="exampleSelectd">
                                                 <option value="Senin">Senin</option>
                                                 <option value="Selasa">Selasa</option>
                                                 <option value="Rabu">Rabu</option>
                                                 <option value="Kamis">Kamis</option>
                                                 <option value="Jumat">Jumat</option>
                                                 <option value="Sabtu">Sabtu</option>
                                                </select>
                                               </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Jam Mulai</label>
                                                <input class="form-control" name="time-picker-mulai" readonly placeholder="Select time" type="text"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Jam Akhir</label>
                                                <input class="form-control" id="time-picker-mulai" readonly placeholder="Select time" type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end pr-11">
                                        <button class="btn btn-light-warning" onclick="addNewJadwalElement()"><i class="ki ki-plus icon-sm"></i>Tambah Jadwal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4 d-flex justify-content-center">
                            <button id="button__profile-simpan" class="btn btn-warning m-8">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        var user = @json($user);
        var jadwal = @json($jadwal);
    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/custom/chat/chat.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/profile.js') }}" type="text/javascript"></script>
@endsection
