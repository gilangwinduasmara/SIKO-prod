<div class="card card-custom p-8 bg-light">
    <div class="display-4">
        Expired Date
    </div>
    <div>Pengaturan masa kadaluwarsa konseling ketika konseli tidak merespon atau melanjutkan konsultasi</div>
    <div class="card-body">
        <form class="form-group row" id="form__expiration">
            <label>Batas konseling expired <span class="text-danger">*</span></label>
            <div class="input-group">
                <input name="expired" type="number" class="form-control" required min=1 value="{{$setting->expired}}"/>
                <div class="input-group-append"><span class="input-group-text">Hari</span></div>
            </div>
            <input type="Submit" class="btn btn-warning mt-8" value="Simpan">
        </form>
    </div>
</div>
