<div class="card card-custom border">
    <div class="card-body">
        <div class="row justify-content-between border p-2">
            <div class="col-md-4 my-2 my-md-0">
                <div class="input-icon">
                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query"/>
                    <span>
                        <i class="flaticon2-search-1 text-muted"></i>
                    </span>
                </div>
            </div>
            <button class="btn btn-warning" data-target="#modal__add" data-toggle="modal">Tambah Pengumuman</button>
        </div>
        <table class="datatable datatable-bordered datatable-head-custom mt-8" id="table-inf" pageLength=5>
            <thead>
                <tr>
                    <th title="Field #1">No</th>
                    <th title="Field #2">Tanggal</th>
                    <th title="Field #3">Judul</th>
                    <th title="Field #3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengumumen as $key=>$pengumuman)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$pengumuman->created_at}}</td>
                        <td>{{substr($pengumuman->judul, 0, 42)}}</td>
                        <td>
                            <button data-value="{{$pengumuman->id}}" name="toggle-modal-edit" class="btn btn-link"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="modal__edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <form class="modal-content" id="form_pengumuman__edit">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pengumuman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="pengumuman_id" name="id" hidden>
                        <div class="form-group">
                            <label>Judul<span class="text-danger">*</span></label>
                            <input id="judul" name="judul" type="text" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Isi<span class="text-danger">*</span></label>
                            <textarea id="isi" name="isi" type="text" class="form-control" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-warning font-weight-bold" data-dismiss="modal">Tutup</button>
                        <input type="submit" class="btn btn-warning font-weight-bold" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="modal__add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <form class="modal-content" id="form_pengumuman__create">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Judul<span class="text-danger">*</span></label>
                            <input name="judul" type="text" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Isi<span class="text-danger">*</span></label>
                            <textarea name="isi" type="text" class="form-control" required rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-warning font-weight-bold" data-dismiss="modal">Tutup</button>
                        <input type="submit" class="btn btn-warning font-weight-bold" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
