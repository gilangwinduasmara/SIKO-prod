@extends('layout.default', [
    'header' => false
])
<head>
    <meta charset="utf-8">
    <link rel="icon" href="/browser-icon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="Web site created using create-react-app">
    <link crossorigin=""
          href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&amp;display=swap"
          rel="stylesheet">
    <link crossorigin="" rel="stylesheet" href="/style.css">
    <link crossorigin="" rel="apple-touch-icon" href="/logo192.png">
    <link rel="manifest" href="/manifest.json">
    <title>Satya Wacana Konseling</title>
    <link href="/static/css/2.762fc1a0.chunk.css" rel="stylesheet">
    <link href="/static/css/main.adfdfad2.chunk.css" rel="stylesheet">
        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />
        <link rel="stylesheet" href="/css/owl.carousel.css" />

        {{ Metronic::getGoogleFontsInclude() }}

    <link rel="stylesheet" href="/css/style.bundle.css">
    <link rel="stylesheet" href="/css/app.css">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            let userId = {{Session::get('userId')}};
        </script>
        @foreach (Metronic::initThemes() as $theme)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
        @endforeach



    <style type="text/css">@import url(https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500);</style>
    <style type="text/css">
        :root {
            --tooltip-backcolor: #424242;
            --tooltip-forecolor: #FAFAFA;
        }

        .fab-container {
            bottom: 10vh;
            position: fixed;
            margin: 1em;
            right: 8vw;
        }

        .fab-item {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
            border-radius: 50%;
            border-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 56px;
            height: 56px;
            margin: 20px auto 0;
            position: relative;
            -webkit-transition: transform .1s ease-out, height 100ms ease, opacity 100ms ease;
            transition: transform .1s ease-out, height 100ms ease, opacity 100ms ease;
            text-decoration: none;
        }

        .fab-item:active,
        .fab-item:focus,
        .fab-item:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
            transition: box-shadow .2s ease;
            outline: none;
        }

        .fab-item:not(:last-child) {
            width: 40px;
            height: 0px;
            margin: 0px auto 0;
            opacity: 0;
            -webkit-transform: translateY(50px);
            -ms-transform: translateY(50px);
            transform: translateY(50px);
        }

        .fab-container:hover
        .fab-item:not(:last-child) {
            height: 40px;
            opacity: 1;
            -webkit-transform: none;
            -ms-transform: none;
            transform: none;
            margin: 15px auto 0;
        }

        .fab-item:not(:last-child) i {
            opacity: 0;
        }

        .fab-container:hover
        .fab-item:not(:last-child) i {
            opacity: 1;
        }

        .fab-item:nth-last-child(1) {
            -webkit-transition-delay: 25ms;
            transition-delay: 25ms;
            background-size: contain;
        }

        .fab-item:not(:last-child):nth-last-child(2) {
            -webkit-transition-delay: 50ms;
            transition-delay: 20ms;
            background-size: contain;
        }

        .fab-item:not(:last-child):nth-last-child(3) {
            -webkit-transition-delay: 75ms;
            transition-delay: 40ms;
            background-size: contain;
        }

        .fab-item:not(:last-child):nth-last-child(4) {
            -webkit-transition-delay: 100ms;
            transition-delay: 60ms;
            background-size: contain;
        }

        [tooltip]:before {
            bottom: 25%;
            font-family: arial;
            font-weight: 600;
            border-radius: 2px;
            background: var(--tooltip-backcolor);
            color: var(--tooltip-forecolor);
            content: attr(tooltip);
            font-size: 12px;
            visibility: hidden;
            opacity: 0;
            padding: 5px 7px;
            margin-right: 12px;
            position: absolute;
            right: 100%;
            white-space: nowrap;
        }

        [tooltip]:hover:before,
        [tooltip]:hover:after {
            visibility: visible;
            opacity: 1;
            transition: opacity .1s ease-in-out;
        }

        .fab-item:nth-last-child(1)[tooltip]:hover:before,
        .fab-item:nth-last-child(1)[tooltip]:hover:after {
            transition: opacity .1s step-end;
        }

        .fab-item.fab-rotate:active,
        .fab-item.fab-rotate:focus,
        .fab-item.fab-rotate:hover {
            transform: rotate(45deg);
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.19), 3px 3px 6px rgba(0, 0, 0, 0.23);
            transition: box-shadow .2s ease, transform .1s ease;
            outline: none;
        }

        .fab-item.fab-rotate:nth-last-child(1)[tooltip]:hover:before,
        .fab-item.fab-rotate:nth-last-child(1)[tooltip]:hover:after {
            transform: rotate(-45deg);
            bottom: -60%;
            right: 60%;
        }
    </style>
    <link rel="stylesheet" href="/css/landing.css">
</head>
@section('content')
<header class="header border-0">
    <a href="/">
        <img src="/static/media/logo_baru.e44b41bb.svg" style="cursor: pointer;">
    </a>
    <div>
        <ul class="pb-0">
            <div>
                @if($user)
                <a href="/dashboard" type="button" class="button px-8" style="height: 32px; background: rgb(78, 115, 223); color: white;">
                    @if ($user->role == 'konseli')
                    {{$user->details->nim}}
                    @else
                    @if ($user->role == 'konselor')
                    {{explode(' ',($user->details->nama_konselor." "))[0]}}
                    @endif
                    @endif
                </a>
                @else
                <input id="button__login" type="button" class="button undefined" value="Login" style="width: 120px; height: 32px; background: rgb(78, 115, 223); color: white;">
                @endif
            </div>
        </ul>
    </div>
</header>
    <div class="d-flex flex-column align-items-center">
        <div class="row mt-12 w-100">
            <div class="col-lg-12">
                <a href={{"/pengumuman/".$pengumuman->id}} class="card card-custom rounded-lg border bg-hover-state-light flex-grow-1" style="overflow: hidden">
                    <div class="p-8" style="background-color: #192b45; color: white">
                        {{$pengumuman->judul}}
                    </div>
                    <div class="px-8 py-4">
                        <div class="font-size-xs text-muted">
                            {{$pengumuman->created_at->diffForHumans()}}
                        </div>
                        <div class="text-dark">
                            {{$pengumuman->isi}}
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <a href="/pengumuman" class="row mt-4 w-100 align-items-end justify-content-end">
            <div class="col-lg-12">
                <button type="button" class="btn btn-cleanbtn-icon text-hover-info btn-icon-md" onclick="window.location.href='/dashboard'">
                    <span class="svg-icon svg-icon-lg">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span>Kembali ke daftar pengumuman</span>
                </button>
            </div>
        </a>
    </div>

    <div class="modal fade" id="modal__persetujuan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body text-justify">
                    <div class="h2 text-center">
                        INFORMED CONSENT <br>
                        SURAT PERNYATAAN PERSETUJUAN KONSELING <br>
                        DI SATYA WACANA KONSELING
                    </div>
                    <div class="mt-8">
                        Saya:
                    </div>
                    <table>
                        <tr>
                            <th>Nama</th>
                            <td id="if__nama"></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td id="if__jk"></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td id="if__alamat"></td>
                        </tr>
                    </table>
                    <div class="mt-8">
                        Pada hari ini tanggal , saya yang tersebut di atas menyatakan <b>SETUJU</b> dan <b>BERSEDIA</b> untuk terlibat dan berpartisipasi aktif dalam proses konseling yang dilakukan oleh Konselor di Satya Wacana Counseling.
                        Dalam kegiatan ini, saya telah menyadari, memahami dan menerima bahwa:
                    </div>
                    <ol class="">
                        <li>Saya bersedia terlibat penuh dan aktif selama proses konseling berlangsung.</li>
                        <li>Saya diminta untuk memberikan informasi yang sejujur-jujurnya berkaitan dengan masalah yang saya hadapi.</li>
                        <li>Identitas dan informasi yang saya berikan akan <b>DIRAHASIAKAN</b> dan tidak akan disampaikan secara terbuka kepada umum.</li>
                        <li>Saya menyetujui adanya perekaman proses konseling berupa tulisan rekaman percakapan selama proses terapi berlangsung dengan jaminan informasi pribadi saya dirahasiakan.</li>
                        <li>Guna menunjang kelancaran proses yang akan dilaksanakan, maka segala hal yang terkait dengan waktu dan tempat akan disepakati bersama.</li>
                    </ol>
                    <input required type="checkbox" name="" id="checkbox__agree" >
                    <span for="">
                        Dengan ini, Saya menyatakan bahwa <b>TIDAK ADA PAKSAAN</b> dari pihak manapun sehingga Saya bersedia untuk mengikuti proses konseling ini dari awal hingga selesai serta menerima segala hal terkait dengan pelaksanaan kegiatan ini.
                    </span>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary font-weight-bold" id="button__setuju" disabled>Daftar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal__register" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content" id="modal-content_login " >
                <div class="modal-body px-8" >
                    <form class="d-flex flex-column align-items-center justify-content-center" id="form__register">
                        <div class="row justify-content-center align-items-center">
                            <div class="d-flex flex-column align-items-center">
                                <div class="symbol symbol-50 symbol-circle">
                                    <img id="img-avatar" src="/avatars/default.jpg" alt="">
                                </div>
                                <input id="input_file" type="file" value="Tambah Foto" hidden>
                                <input type="text" value="" name="avatar" hidden>
                                <button id="button_foto" class="btn btn-warning">Pilih Foto</button>
                            </div>
                        </div>
                        <div class="row w-100 align-items-start mt-8">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama <span class="text-danger">*</span></label>
                                    <input name="nama_konseli" id="input__nama" type="text" class="form-control" />
                                    <input name="name" id="input__name" type="text" class="form-control" hidden/>
                                </div>
                                <div class="form-group">
                                    <label>No. Hp <span class="text-danger">*</span></label>
                                    <input name="no_hp_konseli" id="input__nohp" type="text" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>No. Hp Kerabat <span class="text-danger">*</span></label>
                                    <input name="no_hp_kerabat" id="input__nohp_kerabat" type="text" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Hubungan <span class="text-danger">*</span></label>
                                    <select id="select__hubungan" class="form-control form-control-sm">
                                        <option value="" id=""></option>
                                        <option value="Wali" id="">Wali</option>
                                        <option value="Ayah" id="">Ayah</option>
                                        <option value="Ibu" id="">Ibu</option>
                                        <option value="Saudara" id="">Saudara</option>
                                        <option value="Teman" id="">Teman</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>NIM <span class="text-danger">*</span></label>
                                    <input name="nim" id="input__nim" type="text" class="form-control" readonly/>
                                </div>
                                <div class="form-group">
                                    <label>Fakultas <span class="text-danger">*</span></label>
                                    <input name="fakultas" id="input__fakultas" type="text" class="form-control" readonly/>
                                </div>
                                <div class="form-group">
                                    <label>Prodi <span class="text-danger">*</span></label>
                                    <input name="progdi" id="input__prodi" type="text" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" id="select__gender" class="form-control form-control-sm" id="exampleSelects">
                                        <option value="">Pilih</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Agama<span class="text-danger">*</span></label>
                                    <select name="agama" id="select__agama" class="form-control form-control-sm" id="exampleSelects" >
                                        <option value="">Pilih</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Kong Hu Cu">Kong Hu Cu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input name="tgl_lahir_konseli" id="input__tanggallahir" class="form-control" type="date" value="" id="example-date-input"/>
                                </div>
                                <div class="form-group">
                                    <label>Suku <span class="text-danger">*</span></label>
                                    <input name="suku" id="input__suku" type="text" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Alamat Asal <span class="text-danger">*</span></label>
                                    <input name="alamat_konseli" id="input__alamat" type="text" class="form-control" />
                                </div>
                                <input name="email" type="email" hidden id="input__email">
                            </div>
                        </div>
                        <input class="btn btn-warning" value="Simpan" type="submit" hidden>
                        <button id="button__lanjut" class="btn btn-warning">Lanjut</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal__login" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" style="max-height: 100vh">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-content_login" >
                <div class="modal-body">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Login Sebagai</h5>
                    <div class="role-select">
                        <div id="toggle__selected" class="toggle">konseli</div>
                        <a href="#" class="active-role" style="color: #749ecd">konseli</a>
                        <a href="#" class="role" style="color: #749ecd">konselor</a>
                    </div>
                </div>
                <form class="d-flex flex-column align-items-center justify-content-center" id="form__login">
                    <div class="popup-forms">
                        <input type="text" hidden value="konseli" name="role">
                        <input id="login-email" name="email" placeholder="NIM">
                        <input class="my-2" name="password" placeholder="Password" type="password">
                    </div>
                    <div class="button-submit px-4 mt-2"><input type="Submit" class="button undefined" value="Login" style="height: 38px; background: rgb(118, 159, 205); color: white; width: 170px;"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
@if (config('layout.page-loader.type') != '')
    @include('layout.partials._page-loader')
@endif

{{--@include('layout.base._layout')--}}

<script>var HOST_URL = "{{ route('quick-search') }}";</script>

{{-- Global Config (global config for global JS scripts) --}}
<script>
    var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>
@foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach
<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
<script src="/js/owl.carousel.js" type="text/javascript"></script>
<script src="/js/src/config.js" type="text/javascript"></script>
<script src="/js/src/landing.js" type="text/javascript"></script>
<script src="{{ asset('js/pages/features/miscellaneous/toastr.js') }}" type="text/javascript"></script>
