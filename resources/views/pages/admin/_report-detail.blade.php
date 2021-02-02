<div class="card card-custom border">
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-md-3 my-2 my-md-0">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" aria-controls="kt_datatable"/>
                                <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <select class="form-control" id="kt_datatable_search_fakultas">
                                    <option value="">Fakultas</option>
                                    @foreach ($fakultas as $key=>$f)
                                        <option value="{{$f}}">{{$f}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <select class="form-control" id="kt_datatable_search_status">
                                    <option value="">Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 my-2 my-md-0">
                            <div class="input-group date" >
                                <input type="text" class="form-control" readonly  id="datepicker_dari" placeholder="Dari"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 my-2 my-md-0">
                            <div class="input-group date" >
                                <input type="text" class="form-control" readonly  id="datepicker_sampai" placeholder="Sampai"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {{json_encode($presensis)}} --}}
        <table id="kt_datatable" pageLength=5>
            <thead>
            <tr>
                <th title="Field #1">Nama Konselor</th>
                <th title="Field #2">Id</th>
                <th title="Field #3">Fakultas</th>
                <th title="Field #4">Program Studi</th>
                <th title="Field #5">Suku</th>
                <th title="Field #6">Agama</th>
                <th title="Field #6">Status</th>
                <th title="Field #6">Jumlah Sesi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($konselings as $key=>$konseling)
                    <tr>
                        <td>{{$konseling->konselor->nama_konselor}}</td>
                        <td>{{$konseling->id}}</td>
                        <td>{{$konseling->konseli->fakultas}}</td>
                        <td>{{$konseling->konseli->progdi}}</td>
                        <td>{{$konseling->konseli->suku}}</td>
                        <td>{{$konseling->konseli->agama}}</td>
                        <td>
                            {{-- {{$konseling->status_selesai == "C" ? 'Aktif': 'Selesai'}}</td> --}}
                            @php
                                // return;
                                if($konseling->status_selesai == "expired"){
                                    echo "Expired";
                                }else if($konseling->status_selesai == "E"){
                                    echo "Selesai";
                                }else if($konseling->status_selesai == "C"){
                                    if($konseling->refered == "ya"){
                                        echo "Selesai";
                                    }else{
                                        echo "Aktif";
                                    }
                                }
                            @endphp
                        <td><button class="btn btn-link text-warning" data-toggle="modal" data-target={{"#modal__rk_".$konseling->id}} name="" class="text-warning" href="#">{{count(((array)json_decode(json_encode($konseling))->rekam_konselings))}}</button></td>
                    </tr>

                @endforeach
            </tbody>
        </table>

        @foreach ($konselings as $konseling)
        <div class="modal fade" id={{"modal__rk_".$konseling->id}} tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="height: 300px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam berakhir sesi</th>
                                    <th scope="col">Topik</th>
                                    <th scope="col">Rekam Konseling</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (json_decode(json_encode($konseling))->rekam_konselings as $key=>$rk)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{explode("T",$rk->created_at)[0]}}</td>
                                        <td>{{$konseling->jadwal->jam_akhir.":00"}}</td>
                                        <td>{{$rk->judul_konseling}}</td>
                                        <td>{{$rk->isi_rekam_konseling}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>



</div>


