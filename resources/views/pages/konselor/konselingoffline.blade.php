@extends('layout.default')

@section('content')
    <div class="container mt-8">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header border-0 pt-6 mb-2">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Konseling Offline</span>
                            {{-- <span class="text-muted font-weight-bold font-size-sm">More than 400+ new members</span> --}}
                        </h3>
                        <div class="card-toolbar">
                            @if ($user->role == 'konselor')
                                <button class="btn btn-light-primary" data-target="#modal__create_konseling_offline" data-toggle="modal">Konseling Baru</button>
                            @endif
                        </div>
                    </div>
                    <div class="card-body pt-2">
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
                                            <div class="input-group date" >
                                                <input type="text" class="date_range form-control" readonly  id="datepicker_dari" placeholder="Dari"/>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                    <i class="la la-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 my-2 my-md-0">
                                            <div class="input-group date" >
                                                <input type="text" class="date_range form-control" readonly  id="datepicker_sampai" placeholder="Sampai"/>
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
                        <div class="d-flex justify-content-center mt-12">
                            {{-- <div class="spinner" id="spinner_wrapper"></div> --}}
                        </div>
                        <div class="text-center" id="konseling_offline__empty_state" style="display: none">Belum ada konseling offline</div>
                        <div class="">
                            <table class="table table-separate table-head-custom table-checkable">
                                <thead>
                                    <tr>
                                        @if($user->role == 'admin')
                                            <td>ID Konseling</td>
                                            <td>Konselor</td>
                                            @else
                                            <td>Konseli</td>
                                        @endif
                                        <td>Unit Asal Konseli</td>
                                        <td>Tempat</td>
                                        <td>Waktu</td>
                                        <td></td>
                                        {{-- <td>Topik</td>
                                        <td>Rekam Konseling</td>
                                        <td>Rumusan Masalah</td>
                                        <td>Treatment</td> --}}
                                    </tr>
                                </thead>
                                <tbody id="konseling_offlines_wrapper">
                                    {{-- <tr>
                                        <td class="align-middle w-50px pl-0 pr-2 pb-6">
                                            <div class="symbol symbol-50 symbol-light-success">
                                                <div class="symbol-label" style="background-image: url('/metronic/theme/html/demo5/dist/assets/media/stock-600x400/img-26.jpg')"></div>
                                            </div>
                                        </td>
                                        <td class="align-middle pb-6 w-200px">
                                            <div class="font-size-lg font-weight-bolder text-dark-75 mb-1">Nama</div>
                                            <div class="font-weight-bold text-muted">Unit Asal</div>
                                        </td>
                                        <td class="text-right align-middle pb-6 w-200px">
                                            <div class="font-size-lg font-weight-bolder text-dark-75">$600.00</div>
                                            <div class="font-weight-bold text-muted mb-1">Waktu</div>
                                        </td>
                                        <td class="text-right align-middle pb-6">
                                            <a href="#" class="btn btn-icon btn-light btn-sm">
                                                <span class="svg-icon svg-icon-success">
                                                    <span class="svg-icon svg-icon-md">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo5/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                            </a>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal__edit_konseling_offline" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Konseling Offline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form id="form__edit_konseling_offline" action="/services/konselingoffline/x" method="POST">
                    <input type="text" name="_method" value="PUT" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Konseli</label>
                            <input required type="text" class="form-control" required name="nama_konseli">
                        </div>
                        <div class="form-group">
                            <label for="">Unit Asal Konseli</label>
                            <input required type="text" class="form-control" required name="unit_asal_konseli">
                        </div>
                        <div class="form-group">
                            <label for="">Tempat</label>
                            <input required type="text" class="form-control" required name="tempat">
                        </div>
                        <div class="form-group">
                            <label for="">Waktu</label>
                            <input required type="date" class="form-control" required name="waktu">
                        </div>
                        <div class="form-group">
                            <label for="">Topik</label>
                            <input required type="text" class="form-control" required name="topik">
                        </div>
                        <div class="form-group">
                            <label for="">Rekam Konseling</label>
                            <textarea required id="" cols="30" rows="10" class="form-control" required name="rekam_konseling"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Rumusan Masalah</label>
                            <textarea required id="" cols="30" rows="10" class="form-control" required name="rumusan_masalah"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Treatment</label>
                            <textarea required id="" cols="30" rows="10" class="form-control" required name="treatment"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal__create_konseling_offline" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="exampleModalLabel">Konseling Offline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form action="/services/konselingoffline" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Konseli</label>
                            <input required type="text" class="form-control" name="nama_konseli">
                        </div>
                        <div class="form-group">
                            <label for="">Unit Asal Konseli</label>
                            <input required type="text" class="form-control" name="unit_asal_konseli">
                        </div>
                        <div class="form-group">
                            <label for="">Tempat</label>
                            <input required type="text" class="form-control" name="tempat">
                        </div>
                        <div class="form-group">
                            <label for="">Waktu</label>
                            <input required type="date" class="form-control" name="waktu">
                        </div>
                        <div class="form-group">
                            <label for="">Topik</label>
                            <input required type="text" class="form-control" name="topik">
                        </div>
                        <div class="form-group">
                            <label for="">Rekam Konseling</label>
                            <textarea required id="" cols="30" rows="10" class="form-control" name="rekam_konseling"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Rumusan Masalah</label>
                            <textarea required id="" cols="30" rows="10" class="form-control" name="rumusan_masalah"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Treatment</label>
                            <textarea required id="" cols="30" rows="10" class="form-control" name="treatment"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal__konseling_offline_detail" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Konseling Offline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Topik</label>
                        <input disabled type="text" class="form-control" name="detail_topik">
                    </div>
                    <div class="form-group">
                        <label for="">Rekam Konseling</label>
                        <textarea disabled id="" cols="30" rows="10" class="form-control" name="detail_rekam_konseling"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Rumusan Masalah</label>
                        <textarea disabled id="" cols="30" rows="10" class="form-control" name="detail_rumusan_masalah"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Treatment</label>
                        <textarea disabled id="" cols="30" rows="10" class="form-control" name="detail_treatment"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <script>
        $('.date_range').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            // templates: arrows
        });
        var isKonselingOfflineLoading = true;
        let table = null;
        async function getKonselingOfflines(){
            // $('#spinner_wrapper').show();
            // let konseling_offlines = await axios.get('/services/konselingoffline').then()
            // $('#spinner_wrapper').hide();
            // const konseling_offlines_wrapper = $('#konseling_offlines_wrapper')
            // if(konseling_offlines.data.data.length == 0){
            //     $('#konseling_offline__empty_state').show();
            // }
            // konseling_offlines.data.data.map((konseling_offline) => {
            //     konseling_offlines_wrapper.append(`
            //         <tr>
            //             <td class="align-middle pb-6 w-200px">
            //                 <div class="font-size-lg font-weight-bolder text-dark-75 mb-1">${konseling_offline.nama_konseli}</div>
            //                 <div class="font-weight-bold text-muted">${konseling_offline.unit_asal_konseli}</div>
            //             </td>
            //             <td class="text-right align-middle pb-6 w-200px">
            //                 <div class="font-size-lg font-weight-bolder text-dark-75">${konseling_offline.tempat}</div>
            //                 <div class="font-weight-bold text-muted mb-1">${konseling_offline.waktu}</div>
            //             </td>
            //             <td class="text-right align-middle pb-6">
            //                 <button href="#" class="btn btn-icon btn-light btn-sm button__open_detail" data-topik="${konseling_offline.topik}" data-rekam_konseling="${konseling_offline.rekam_konseling}" data-rumusan_masalah="${konseling_offline.rumusan_masalah}" data-treatment="${konseling_offline.treatment}">
            //                     <span class="svg-icon svg-icon-success">
            //                         <span class="svg-icon svg-icon-md">
            //                             <!--begin::Svg Icon | path:/metronic/theme/html/demo5/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
            //                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            //                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            //                                     <polygon points="0 0 24 0 24 24 0 24"></polygon>
            //                                     <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
            //                                     <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
            //                                 </g>
            //                             </svg>
            //                             <!--end::Svg Icon-->
            //                         </span>
            //                     </span>
            //                 </button>
            //                 <button data-id="${konseling_offline.id}" href="javascript:;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2 button__open_edit" title="Edit details"><span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path></g></svg></span></a>
            //             </td>
            //         </tr>
            //     `)
            // })
            table = $('table').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrtip',
                order: [[0, 'desc']],
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                    {
                        extend: 'excel',
                        title: 'Daftar Absensi Konseling Offline'
                    },
                    {
                        extend: 'pdf',
                        title: 'Daftar Absensi Konseling Offline \nSatya Wacana Counseling'
                    },
                    {
                        extend: 'print',
                        title: 'Daftar Absensi Konseling Offline \nSatya Wacana Counseling'
                    },
                ],
                ajax: {
                    url: '/services/konselingoffline/dt',
                    type: 'POST',
                    data: function (d) {
                        d.from = $('#datepicker_dari').val();
                        d.to = $('#datepicker_sampai').val();
                        d._token = "{{csrf_token()}}"
                    }
                },
                columns: [
                    <?php
                        if($user->role == 'admin'){
                            echo ("{ data: 'id', name: 'id' },{ data: 'konselor.nama_konselor', name: 'konselor.nama_konselor' },");
                        }else{
                            echo ("{ data: 'nama_konseli', name: 'nama_konseli' },");
                        }
                    ?>
                    { data: 'unit_asal_konseli', name: 'unit_asal_konseli' },
                    { data: 'tempat', name: 'tempat' },
                    { data: 'waktu', name: 'waktu' },
                    {
                        sortable: false,
                        render: function(data, type, konseling_offline, meta){
                        return(
                            `
                            <button href="#" class="btn btn-icon btn-light btn-sm button__open_detail" data-topik="${konseling_offline.topik}" data-rekam_konseling="${konseling_offline.rekam_konseling}" data-rumusan_masalah="${konseling_offline.rumusan_masalah}" data-treatment="${konseling_offline.treatment}">
                                 <span class="svg-icon svg-icon-success">
                                     <span class="svg-icon svg-icon-md">
                                         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                 <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                                 <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                                             </g>
                                         </svg>
                                     </span>
                                 </span>
                             </button>
                             <button <?php if($user->role == 'admin') echo('hidden') ?> data-id="${konseling_offline.id}" href="javascript:;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2 button__open_edit" title="Edit details"><span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path></g></svg></span></a>
                            `
                        )
                    } },
                ]
            });
            $('.dt-button').addClass('btn btn-outline-primary btn-shadow');
            $('.buttons-excel').prepend('<i class="far fa-file-excel"></i>')
            $('.buttons-pdf').prepend('<i class="far fa-file-pdf"></i>')
            $('.buttons-print').prepend('<i class="fas fa-print"></i>')
            $('.dataTables_filter').hide();
            $('.date_range').change(function(){
                var min  = $('#datepicker_dari').val();
                var max  = $('#datepicker_sampai').val();
                table.draw()
            })
            $('table').on('click', '.button__open_detail', function(){
                $('[name="detail_topik"]').val($(this).data('topik'))
                $('[name="detail_rekam_konseling"]').val($(this).data('rekam_konseling'))
                $('[name="detail_rumusan_masalah"]').val($(this).data('rumusan_masalah'))
                $('[name="detail_treatment"]').val($(this).data('treatment'))
                $('#modal__konseling_offline_detail').modal('show')
            })
            $('table').on('click', '.button__open_edit', function(){
                const konselingId = $(this).data('id')
                $('#form__edit_konseling_offline').attr("action", "/services/konselingoffline/"+konselingId)
                console.log(konselingId)
                const konseling = table.rows().data().filter((konseling_offline) => (konseling_offline.id === konselingId))[0]
                Object.keys(konseling).map((key) => {
                    console.log(konseling[key])
                    $('#form__edit_konseling_offline').find(`[name="${key}"]`).val(konseling[key])
                })
                // $('[name="detail_rekam_konseling"]').val($(this).data('rekam_konseling'))
                // $('[name="detail_rumusan_masalah"]').val($(this).data('rumusan_masalah'))
                // $('[name="detail_treatment"]').val($(this).data('treatment'))
                // $('#modal__konseling_offline_detail').modal('show')
                $('#modal__edit_konseling_offline').modal('show')
            })
            $('#kt_datatable_search_query').keyup(function(){
                table.column(0).search($(this).val()).draw();
            })
        }

        $(document).ready(function(){
            getKonselingOfflines();
        })
    </script>
@endsection
