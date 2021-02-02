{{-- Extends layout --}}
@extends('layout.default')

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            @if(request()->submenu == 'pengumuman')
            @include('pages.admin._informasi-pengumuman')
            @else
            @include('pages.admin._informasi-quote')
            @endif
        </div>
    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/src/dropdown.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/src/session.js')}}"></script>
    <script>
        $(document).ready(function(){
            @if(request()->submenu == "pengumuman")
                var pengumumen = @json($pengumumen ?? []);
                $('[name="toggle-modal-edit"]').click(function(){
                    const v = $(this).data('value');
                    $('#modal__edit').modal('show');
                    console.log(pengumumen, v)
                    const pengumuman = pengumumen.filter((o, i) => (o.id == v))[0]
                    console.log(pengumuman)
                    $('#judul').val(pengumuman.judul)
                    $('#isi').val(pengumuman.isi)
                    $('#pengumuman_id').val(pengumuman.id)
                })
                $('#form_pengumuman__edit').submit(function(e){
                    e.preventDefault()
                    toastr.options = conf.toastr.options.saving;
                    toastr.info("Sedang memproses data")
                    axios.put('/services/pengumuman', $(this).serialize()).then(res => {
                        console.log(res.data)
                        window.location.reload();
                    })
                })
                $('#form_pengumuman__create').submit(function(e){
                    e.preventDefault()
                    toastr.options = conf.toastr.options.saving;
                    toastr.info("Sedang memproses data")
                    axios.post('/services/pengumuman', $(this).serialize()).then(res => {
                        console.log(res.data)
                        window.location.reload();
                    })
                })
            @else
            var quotes = @json($quotes ?? []);
            $('[name="toggle-modal-edit"]').click(function(){
                    const v = $(this).data('value');
                    $('#modal__edit').modal('show');
                    console.log(quotes, v)
                    const quote = quotes.filter((o, i) => (o.id == v))[0]
                    console.log(quote)
                    $('#oleh').val(quote.oleh)
                    $('#quote').val(quote.quote)
                    $('#quote_id').val(quote.id)
                })
                $('#form_quote__edit').submit(function(e){
                    e.preventDefault()
                    toastr.options = conf.toastr.options.saving;
                    toastr.info("Sedang memproses data")
                    axios.put('/services/quote', $(this).serialize()).then(res => {
                        console.log(res.data)
                        window.location.reload();
                    })
                })
                $('#form_quote__create').submit(function(e){
                    $(this).unbind();
                    e.preventDefault()
                    toastr.options = conf.toastr.options.saving;
                    toastr.info("Sedang memproses data")
                    axios.post('/services/quote', $(this).serialize()).then(res => {
                        console.log(res.data)
                        window.location.reload();
                    })
                })
            @endif


        })

        var datatable = $('#table-inf').KTDatatable({
            translate: conf.datatable.translate,
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },
            layout: {
                class: 'datatable-bordered',
                scroll: true
            },
            responsive: {
                details: false
            },
            columns: [,
                {
                    field: 'No',
                    title: 'No',
                    width: 40
                },
                {
                    field: 'Status',
                    title: 'Status',
                    template: function(row) {
                    var status = {
                        1: {
                            'title': 'All',
                            'class': ' label-light-warning'
                        },
                        2: {
                            'title': 'Aktif',
                            'class': ' label-light-info'
                        },
                        3: {
                            'title': 'Selesai',
                            'class': ' label-light-success'
                        }
                    };
                    return '<span class="label font-weight-bold label-lg' + status[row.Status].class + ' label-inline">' + status[row.Status].title + '</span>';
                    },
                },
                {
                    field: 'Keterangan',
                    title: 'Keterangan',
                    template: function(row) {
                    var keterangan = {
                        1: {
                            'title': 'All',
                            'class': ' label-light-warning'
                        },
                        2: {
                            'title': 'Baru',
                            'class': ' label-light-info'
                        },
                        3: {
                            'title': 'Referral',
                            'class': ' label-light-success'
                        }
                    };
                    return '<span class="label font-weight-bold label-lg' + keterangan[row.Keterangan].class + ' label-inline">' + keterangan[row.Keterangan].title + '</span>';
                    },
                }
            ],
    });
    </script>
@endsection
