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
            <button class="btn btn-warning" data-target="#modal__add" data-toggle="modal">Tambah Quote</button>
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
                @foreach ($quotes as $key=>$quote)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$quote->created_at}}</td>
                        <td>
                            <div class="text-truncate">
                                {{substr($quote->quote, 0, 42)}}
                            </div>
                        </td>
                        <td>
                            <button data-value="{{$quote->id}}" name="toggle-modal-edit" class="btn btn-link"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="modal__edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content" id="form_quote__edit">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Quote</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="quote_id" name="id" hidden>
                        <div class="form-group">
                            <label>Oleh<span class="text-danger">*</span></label>
                            <input id="oleh" name="oleh" type="text" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Quote<span class="text-danger">*</span></label>
                            <textarea id="quote" name="quote" type="text" class="form-control" required></textarea>
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
            <div class="modal-dialog" role="document">
                <form class="modal-content" id="form_quote__create">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Quote</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Oleh<span class="text-danger">*</span></label>
                            <input name="oleh" type="text" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Quote<span class="text-danger">*</span></label>
                            <textarea name="quote" type="text" class="form-control" required></textarea>
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
