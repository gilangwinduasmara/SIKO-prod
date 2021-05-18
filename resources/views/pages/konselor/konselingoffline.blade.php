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
                        <div class="d-flex justify-content-center mt-12">
                            <div class="spinner" id="spinner_wrapper"></div>
                        </div>
                        <div class="text-center" id="konseling_offline__empty_state" style="display: none">Belum ada konseling offline</div>
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
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
    <script>
        var isKonselingOfflineLoading = true;
        async function getKonselingOfflines(){
            $('#spinner_wrapper').show();
            let konseling_offlines = await axios.get('/services/konselingoffline').then()
            $('#spinner_wrapper').hide();
            const konseling_offlines_wrapper = $('#konseling_offlines_wrapper')
            if(konseling_offlines.data.data.length == 0){
                $('#konseling_offline__empty_state').show();
            }
            konseling_offlines.data.data.map((konseling_offline) => {
                konseling_offlines_wrapper.append(`
                    <tr>
                        <td class="align-middle pb-6 w-200px">
                            <div class="font-size-lg font-weight-bolder text-dark-75 mb-1">${konseling_offline.nama_konseli}</div>
                            <div class="font-weight-bold text-muted">${konseling_offline.unit_asal_konseli}</div>
                        </td>
                        <td class="text-right align-middle pb-6 w-200px">
                            <div class="font-size-lg font-weight-bolder text-dark-75">${konseling_offline.tempat}</div>
                            <div class="font-weight-bold text-muted mb-1">${konseling_offline.waktu}</div>
                        </td>
                        <td class="text-right align-middle pb-6">
                            <button href="#" class="btn btn-icon btn-light btn-sm button__open_detail" data-topik="${konseling_offline.topik}" data-rekam_konseling="${konseling_offline.rekam_konseling}" data-rumusan_masalah="${konseling_offline.rumusan_masalah}" data-treatment="${konseling_offline.treatment}">
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
                            </button>
                        </td>
                    </tr>
                `)
            })
            $('table').DataTable()

            $('.button__open_detail').click(function(){
                $('[name="detail_topik"]').val($(this).data('topik'))
                $('[name="detail_rekam_konseling"]').val($(this).data('rekam_konseling'))
                $('[name="detail_rumusan_masalah"]').val($(this).data('rumusan_masalah'))
                $('[name="detail_treatment"]').val($(this).data('treatment'))
                $('#modal__konseling_offline_detail').modal('show')
            })
        }
        $(document).ready(function(){
            getKonselingOfflines();
        })
    </script>
@endsection
