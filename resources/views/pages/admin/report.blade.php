{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            @if(request()->detail)
            @include('pages.admin._report-detail')
            @else
            @include('pages.admin._report-presensi')
            @endif
        </div>
    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
            var detail = {{request()->get('detail') ?? 'false'}}
            var presensis = @json($presensis ?? [])
    </script>
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/src/dt.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/src/session.js')}}"></script>
    <script>
        $(document).ready(function(){

            $('#datepicker_dari').datepicker({
                rtl: KTUtil.isRTL(),
                clearBtn: true
            });
            $('#datepicker_sampai').datepicker({
                rtl: KTUtil.isRTL(),
                clearBtn: true
            });

            $('button[name="toggle-rk"]').click(function(e){
                e.preventDefault();
                $('#modal__rk').modal('show');
            })
            $('#kt_datatables','[name="toggle-detail"]').click(function(e){
                e.preventDefault();

            })

            $("#kt_datatable").on("click", '[name="toggle-detail"]', function(){
                const v = $(this).data('value');
                const p = presensis.filter((o, i) => (o.id == v))[0]
                $('#rk__detail').text(p.isi_rekam_konseling);
                $('#modal__detail').modal('show');
            });

        })
    </script>
@endsection
