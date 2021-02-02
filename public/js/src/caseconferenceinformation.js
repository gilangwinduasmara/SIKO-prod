
function renderCaseConferenceInformation(caseId){
    $('.empty-state').hide();
    $('#chat-container').hide();
    $('#conference-information-container').show();
    axios.get(`/services/conference?case_conference_id=${caseId}`).then(res => {
        $('#judul-conference').text(": "+res.data.rows.judul_case_conference);
        let detailList = "";
        let listTambahKonselor = "";
        let konselorIds = [];
        res.data.rows.detail_conferences.map((item, index) => {
            if(item.konselor_id == user.details.id){
                if(item.role == "host"){
                    $('#button__tambahkonselor').show();
                }else{
                    $('#button__tambahkonselor').hide();
                }
            }
            detailList+=`
            <div class="d-flex align-items-center mb-10">
                <div class="symbol symbol-40 symbol-light-white mr-5">
                    <img class="img-fit" src="/avatars/${item.konselor.user.avatar}" alt="">
                </div>
                <div class="d-flex flex-column font-weight-bold">
                    <div>
                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">${item.konselor.nama_konselor}</a>
                        <span class="label label-lg label-light-success label-inline ml-6">${capitalizeFirstLetter(item.role)}</span>
                    </div>
                    <span class="text-muted">${item.konselor.profesi_konselor}</span>
                </div>
            </div>
            `;
            konselorIds.push(item.konselor.id);
        });
        $('#list-detail-conference').html(detailList);
        console.log(konselorIds);
        konselors.map((item, index) => {
            if(konselorIds.indexOf(item.id)===-1){
                listTambahKonselor += `
                <tr>
                    <td class="pl-0">
                        <label class="checkbox checkbox-lg checkbox-inline">
                            <input id="checkbox__konselor_selector_${item.id}" type="checkbox" value=${item.id}>
                            <span></span>
                        </label>
                    </td>
                    <td class="pr-0">
                        <div class="symbol symbol-50 symbol-light mt-1">
                            <span class="symbol-label">
                                <img src="/avatars/${item.user.avatar}" class="h-75 align-self-end" alt="">
                            </span>
                        </div>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">${item.nama_konselor}</a>
                    </td>
                    <td>
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">${item.profesi_konselor}</a>
                    </td>
                </tr>
                `
            }
        })
        $('#list__tambahkonselor').html(listTambahKonselor);

    })
}

$(document).ready(function(){
    $('#conference-information-container').hide();
    $('#chat-container').hide();
    // renderCaseConferenceInformation(selectedCaseconference.id);
    $('#button__lihat_profile').click(function(){
        $('.profile-konseli').hide();
        $('#modal__profile_konseli').modal('show')
        $('.spinner-modal-profile').show();
        axios.get('/services/konseli/'+selectedCaseconference.konseling.konseli_id).then(res=>{
            const konseli = res.data.data
            console.log(konseli)
            $('#popup__nama').text(konseli.nama_konseli)
            $('#popup__nim').text(konseli.nim)
            $('#popup__progdi').text(konseli.progdi)
            $('#popup__jenis_kelamin').text(konseli.jenis_kelamin)
            $('#popup__tgl_lahir').text(konseli.tgl_lahir_konseli)
            $('#popup__agama').text(konseli.agama)
            $('#popup__suku').text(konseli.suku)
            $('#popup__alamat').text(konseli.alamat_konseli)
            $('#popup__avatar').attr('src','/avatars/'+konseli.user.avatar);
            $('.spinner-modal-profile').hide();
            $('.profile-konseli').show();
        })
    })
})


$("#table_list").on("click", 'a[name=konselor_list_item]', function(){
    const selectedId = $(this).data("value")
    selectedCaseconference = caseconferences.filter(function(obj){
        return obj.id === selectedId;
    })[0]
    renderCaseConferenceInformation($(this).data("value"));
    console.log(selectedCaseconference);
});


$('#button__tambahkonselor').click(function(){
    $('#modal__tambahkonselor').modal('show');
})

$('#button__masuk_conference').click(function (){
    $('#chat-container').show();
    $('#conference-information-container').hide();
    showChat();
})
$('#button__tambahkonselor_submit').click(function(){
    let selectedKonselor = [];
    $.each($('input[type="checkbox"]:checked'), function(){
        if(parseInt($(this).val())>0){
            selectedKonselor.push(parseInt($(this).val()))
        }
    })
    axios.post('/services/detailconference', {
        case_conference_id: selectedCaseconference.id,
        memberids: selectedKonselor
    }).then(res => {
        console.log(res.data)
        window.location.href = "/caseconference?id="+selectedCaseconference.id
    })
    return false;
})
