<div class="card card-custom card-stretch gutter-b card-shadowless bg-light">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">History Konseling</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-8">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                <thead>
                    <tr class="text-left">
                        <th class="pr-0" style="min-width: 150px">Tanggal</th>
                        <th style="min-width: 150px">Topik</th>
                        <th style="min-width: 150px">Rekam Konseling</th>
                        <th class="pr-0 text-right" style="min-width: 150px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($konseling->rekam_konselings as $rk)
                    <tr>
                        <td class="pr-0">
                            <span href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$rk->tgl_konseling}}</span>
                        </td>
                        <td class="pl-0">
                            <span href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$rk->judul_konseling}}</span>
                        </td>
                        <td>
                            <span href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$rk->isi_rekam_konseling}}</span>
                        </td>
                        <td>

                            <button class="btn btn-icon btn-light btn-hover-warning btn-sm mx-3" data-toggle="modal" data-target={{"#modal_rekam_konseling__".$rk->id}}>
                                <span class="svg-icon svg-icon-md svg-icon-warning">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo5/dist/assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </button>

                        </td>
                        <td>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Table-->
        @if (count($konseling->rekam_konselings) == 0)
            <center><span class="mb-3">Belum ada history</span></center>
        @endif
    </div>
    @foreach ($konseling->rekam_konselings as $rk)
    <div class="modal fade" id={{"modal_rekam_konseling__".$rk->id}} data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <form class="modal-content" name="form__rekam_konseling">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rekam Konseling</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input  type="text" name="id" value={{$rk->id}} hidden>
                    <div class="form-group">
                        <label>Topik <span class="text-danger">*</span></label>
                        <input {{$type=="arsip"?'readonly':''}} name="judul_konseling" type="text" class="form-control" required value="{{$rk->judul_konseling}}">
                    </div>
                    <div class="form-group">
                        <label>Rekam Konseling <span class="text-danger">*</span></label>
                        <textarea {{$type=="arsip"?'readonly':''}} name="isi_rekam_konseling" type="text" class="form-control" required rows="10" >{{$rk->isi_rekam_konseling}}</textarea>
                    </div>
                </div>
                @if($type != 'arsip')
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-warning font-weight-bold" data-dismiss="modal">Tutup</button>
                    <input type="Submit" class="btn btn-warning font-weight-bold" name="save-rekam-konseling" value="Simpan">
                </div>
                @endif
            </form>
        </div>
    </div>
    @endforeach
    <!--end::Body-->
</div>
