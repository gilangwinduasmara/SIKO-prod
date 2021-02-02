// $('input[name="time-picker-mulai"]').datetimepicker({
//     format: 'HH:mm'
// });
$('input[name="time-picker-mulai"], #kt_timepicker_1_modal').timepicker({
    minuteStep: 60,
    showMeridian: false
});

$('#time-picker-mulai').change(function(){
})

$(document).ready(function(){
    let html = ``
    Object.keys(jadwal).map((hari, index) => {
        jadwal[hari].map((item, index) => {
            const generatedId = makeid(5);
            html += `
            <div class="col-12 row jadwal-item-wrapper">
                <div class="col-4">
                    <div class="form-group">
                        <label for="exampleSelectd">Hari</label>
                        <select data-value=${item.id} class="form-control" id="exampleSelectd">
                            <option ${item.hari=="Senin"?selected="selected":""} value="Senin">Senin</option>
                            <option ${item.hari=="Selasa"?selected="selected":""} value="Selasa">Selasa</option>
                            <option ${item.hari=="Rabu"?selected="selected":""} value="Rabu">Rabu</option>
                            <option ${item.hari=="Kamis"?selected="selected":""} value="Kamis">Kamis</option>
                            <option ${item.hari=="Jumat"?selected="selected":""} value="Jumat">Jumat</option>
                            <option ${item.hari=="Sabtu"?selected="selected":""} value="Sabtu">Sabtu</option>
                        </select>
                        </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input class="form-control" data-token="${generatedId}" name="time-picker-mulai" readonly placeholder="Select time" type="text" value="${item.jam_mulai}:00"/>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Jam Akhir</label>
                        <input class="form-control" data-token="jam-akhir-${generatedId}" name="time-picker-akhir" readonly placeholder="Select time" type="text" value="${item.jam_akhir}:00"/>
                    </div>
                </div>
            </div>
                `
        })
    })
    $('#jadwal-container').html(html);
})

function addNewJadwalElement(){
    const generatedId = makeid(5);
    const html = `
    <div class="col-12 row jadwal-item-wrapper">
        <div class="col-4">
            <div class="form-group position-relative">
                <label for="exampleSelectd">Hari</label>
                <div class="position-absolute" style="left: -15px; top: 50%">
                    <a href="#" class="jadwal-close">
                        <i class="ki ki-close icon-sm text-danger"></i>
                    </a>
                </div>
                <select data-value="new" class="form-control border-info" id="exampleSelectd">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Jam Mulai</label>
                <input class="form-control border-info" data-token="${generatedId}" name="time-picker-mulai" readonly placeholder="Select time" type="text" value="8:00"/>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Jam Akhir</label>
                <input class="form-control border-info" data-token="jam-akhir-${generatedId}" name="time-picker-akhir" readonly placeholder="Select time" type="text" value="9:00"/>
            </div>
        </div>
    </div>
    `;
    $('#jadwal-container').append(html);
}


$(document).on('focus','input[name="time-picker-mulai"]', function(){
    $('input[name="time-picker-mulai"]').timepicker({
        format: 'HH:mm',
        minuteStep: 60,
        showMeridian: false
    });
    $('input[name="time-picker-mulai"]').change(function(){
        const v = parseInt($(this).val().split(":")[0]);
        $(`[data-token="jam-akhir-${$(this).data('token')}"]`).val((v+1)+":00")
    });
});
$(document).on('focus','.jadwal-close', function(){
    $('.jadwal-close').click(function(e){
        e.preventDefault();
        $(this).closest('.jadwal-item-wrapper').remove();
    })
});

let profileSimpanLoading = false;
$('#button__profile-simpan').click(function(){
    if(profileSimpanLoading){
        return false
    }
    profileSimpanLoading = true;
    toastr.options = conf.toastr.options.saving;
    toastr.info("Menyimpan Data");
    const dataJadwal = [];
    const personal = $('#form-personal').serializeObject();
    $.each($("select"), function(i,v){
        dataJadwal.push({
            id: $(this).data("value"),
            hari: $(this).val(),
            jam_mulai: parseInt($($($(this).closest(".jadwal-item-wrapper").children()[1]).children(".form-group")).children("input").val().split(":")[0])
        })
    })

    let checkJadwal = dataJadwal.map((item, index) => ({hari: item.hari, jam_mulai: item.jam_mulai}))
    let tmp = [];
    let conflict = false;
    for(var i=0; i<checkJadwal.length; i++){
        for(var j=0; j<checkJadwal.length; j++){
            if(i!=j){
                if(JSON.stringify(checkJadwal[i]) == JSON.stringify(checkJadwal[j])){
                    conflict = true;
                    break
                }
            }
        }
        if(conflict) break;
    }

    if(conflict){
        profileSimpanLoading = false;
        Swal.fire("", "Tidak boleh ada jadwal yang sama!", "error");
        toastr.clear();
    }else{
        axios.post('/services/user/edit',{
            dataJadwal,
            personal
        }).then(res => {
            profileSimpanLoading = false;
            toastr.clear();
            window.location.href = window.location.href
        })
    }

})
