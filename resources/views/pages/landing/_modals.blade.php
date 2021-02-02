<div class="modal fade" id="modal__persetujuan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
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
                    @csrf
                    <div class="row justify-content-center align-items-center">
                        {{-- <div class="d-flex flex-column align-items-center">
                            <div class="symbol symbol-50 symbol-circle">
                                <img id="img-avatar" src="/avatars/default.jpg" alt="">
                            </div>
                            <input id="input_file" type="file" value="Tambah Foto" hidden>
                            <input type="text" value="" name="avatar" hidden>
                            <button id="button_foto" type="button" class="btn btn-warning">Pilih Foto</button>
                        </div> --}}
                    </div>
                    <div class="row w-100 align-items-start mt-8">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input name="nama_konseli" id="input__nama" type="text" class="form-control" readonly/>
                                <input name="name" id="input__name" type="text" class="form-control" hidden/>
                            </div>
                            <div class="form-group">
                                <label>No. Hp <span class="text-danger">*</span></label>
                                <input name="no_hp_konseli" id="input__nohp" type="number" class="form-control" />
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
                            <div class="form-group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" id="select__gender" class="form-control form-control-sm" id="exampleSelects">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-6">
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
                                <input name="tgl_lahir_konseli" id="input__tanggallahir" class="form-control" type="date" min="1971-01-01" value="" id="example-date-input"/>
                            </div>
                            <div class="form-group">
                                <label>Suku <span class="text-danger">*</span></label>
                                <input name="suku" id="input__suku" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Alamat Asal <span class="text-danger">*</span></label>
                                <input name="alamat_konseli" id="input__alamat" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>No. Hp Kerabat <span class="text-danger">*</span></label>
                                <input name="no_hp_kerabat" id="input__nohp_kerabat" type="number" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Hubungan <span class="text-danger">*</span></label>
                                <select name="hubungan" id="select__hubungan" class="form-control form-control-sm">
                                    <option value="" id=""></option>
                                    <option value="Wali" id="">Wali</option>
                                    <option value="Ayah" id="">Ayah</option>
                                    <option value="Ibu" id="">Ibu</option>
                                    <option value="Saudara" id="">Saudara</option>
                                    <option value="Teman" id="">Teman</option>
                                </select>
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
        <div class="modal-content py-8" id="modal-content_login" >
            <div class="modal-body">
                <h5 class="modal-title text-center" id="exampleModalLabel">Login Sebagai</h5>
                <div class="role-select">
                    <div id="toggle__selected" class="toggle">konseli</div>
                    <a href="#" class="active-role" style="color: #749ecd">konseli</a>
                    <a href="#" class="role" style="color: #749ecd">konselor</a>
                </div>
                <div class="row justify-content-center radio-role">
                    <div class="col-3">
                        <div class="form-check">
                            <input class="form-check-input shadow" type="radio" name="exampleRadios" id="radio__m" value="n" checked>
                            <label class="form-check-label" for="exampleRadios1">
                              Mahasiswa
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check">
                            <input disabled class="form-check-input shadow" type="radio" name="exampleRadios" id="radio__d" value="m">
                            <label class="form-check-label" for="exampleRadios2">
                                Dosen / Pegawai
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            <form class="d-flex flex-column align-items-center justify-content-center" id="form__login">
                @csrf
                <div class="popup-forms">
                    <input type="text" hidden value="konseli" name="role">
                    <input id="login-email" name="email" placeholder="NIM">
                    <input class="my-2" name="password" placeholder="Password" type="password">
                </div>

                <div class="text-danger text-center mt-2 error-throttle" style="display: none">
                    Anda sudah mencoba beberapa kali <br>silahkan ditunggu<br>
                    <div class="error-countdown">
                    </div>
                </div>
                <div class="button-submit px-4 mt-4"><input id="button__submit_login" type="Submit" class="button undefined" value="Login" style="height: 38px; background: rgb(118, 159, 205); color: white; width: 170px;"></div>
            </form>
        </div>
    </div>
</div>
