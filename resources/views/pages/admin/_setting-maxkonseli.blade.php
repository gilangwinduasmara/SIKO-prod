<div class="card card-custom p-8 bg-light">
    <div class="display-4">
        Maksimun Konseli
    </div>
    <div>Pengaturan batas maksimum konsel yang bisa ditangani oleh konselor per periode waktu</div>
    <div class="card-body">
        <form class="form-group row" id="form__maxkonseli">
            <label>Batas jumlah konseli <span class="text-danger">*</span></label>
            <div class="input-group">
                <input name="max" type="number" min=1 class="form-control" required value="{{$setting->session_limit}}"/>
                <div class="input-group-append"><span class="input-group-text">Orang</span></div>
            </div>
            <input type="Submit" class="btn btn-warning mt-8" value="Simpan">
        </div>
    </div>
</div>
