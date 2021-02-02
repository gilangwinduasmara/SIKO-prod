
if(performance.navigation.type == 2){
    location.reload(true);
}

$(document).ready(function(){
    tablelist = $('#table_list').KTDatatable({
        translate: conf.datatable.translate,
        search: {
            input: $('#input__cari'),
            key: 'generalSearch'
        },
        sortable: false
    })
    if($('#table_list').data('marginless')){
        setTimeout(()=>{
            $('td').addClass('py-2')
        },1000)
    }
    // $('#input__cari').keyup(function(){
    //     tablelist.search($(this).val())
    // })
})
$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
 }

$('#button__ask_referral').click(function (){
    toastr.options = conf.toastr.options.saving;
    toastr.info("Sedang memproses data")
    let searchParams = new URLSearchParams(window.location.search);
    const konseling_id = searchParams.get('id');
    axios.post('/services/referral/createagreement', {
        konseling_id
    }).then((res) => {
       window.location.href = window.location.href;
    });
});

$('#button__ask_case_conference').click(function (){
    toastr.options = conf.toastr.options.saving;
    toastr.info("Sedang memproses data")
    let searchParams = new URLSearchParams(window.location.search);
    const konseling_id = searchParams.get('id');
    axios.post('/services/conference/createagreement', {
        konseling_id
    }).then((res) => {
       window.location.href = window.location.href;
    });
});

$('#button__masuk_case_conference').click(function(){
    $(this).attr('disabled', 'true')
    toastr.options = conf.toastr.options.saving;
    toastr.info("Sedang memproses data")
    var checkedKonselors = [];
    let searchParams = new URLSearchParams(window.location.search);
    $.each(konselors, function(i, konselor){
        if($('#checkbox__konselor_selector_'+konselor.id).is(':checked')){
            checkedKonselors.push(konselor.id);
        }
    });
    let data = {
        judul_case_conference: $('#input__judul_case').val(),
        konseling_id: searchParams.get('id'),
        konselors:checkedKonselors
    };

    axios.post('/services/conference', data).then(res=>{
        window.location.href = res.data.redirect
    });

});
$('#button__submit_case_conference').click(function(){
    $('#step_2').hide();
    $('#step_3').show();
});

$('#button__submit_referal').click(function(){

})

$('#button__submit_close_case').click(function(){

})

// Informasi Konseli Event Listener

$('button[name="personal_information__ruangkonseling"]').click(function(){
    konselingId = $(this).attr('konselingId');
    $('#chat-container').show();
    showChat();
})

$('button[name="personal_information__caseconference"]').click(function(){
    window.location.href=$(this).attr('href')
})

$('button[name="personal_information__referal"]').click(function(){
    window.location.href=$(this).attr('href')
})
$('button[name="personal_information__rangkumankonseling"]').click(function(){
    // ganti pakai name!
    $('#modal__rangkumankonseling_'+$(this).data('value')).modal('show')
})



$('button[name="konseli__caseconference"]').click(function(){

    $('#modal__case_conference').modal('show');
});

$('button[name="konseli__referral"]').click(function(){

    $('#modal__referral').modal('show');
});

$('#button_caseconference__agree').click(function(){
    toastr.options = conf.toastr.options.saving;
    toastr.info("Sedang memproses data")
    const konseling_id = konseling.id;
    axios.post('/services/conference/createagreement', {
        konseling_id
    }).then((res) => {
        window.location.href = "/dashboard";
    });
});

$('#button_caseconference__decline').click(function(){
    const konseling_id = konseling.id;
    toastr.options = conf.toastr.options.saving;
    toastr.info("Sedang memproses data")
    axios.post('/services/conference/declineagreement', {
        konseling_id
    }).then((res) => {
        window.location.href = "/dashboard";
    });
});

$('#button__close_case').click(function(){
    toastr.options = conf.toastr.options.saving;
    toastr.info("Sedang memproses data")
    const konseling_id = konseling.id;
    axios.post('/services/konseling/end', {
        id: konseling_id
    }).then(res => {
        window.location.href = "/dashboard";
    });
})


$('#button_referral__agree').click(function(){
    toastr.options = conf.toastr.options.saving;
    toastr.info("Sedang memproses data")
    const konseling_id = konseling.id;
    axios.post('/services/referral/createagreement', {
        konseling_id
    }).then((res) => {
        window.location.href = "/dashboard";
    });
});

$('#button_referral__decline').click(function(){
    toastr.options = conf.toastr.options.saving;
    toastr.info("Sedang memproses data")
    const konseling_id = konseling.id;
    axios.post('/services/referral/declineagreement', {
        konseling_id
    }).then((res) => {

        window.location.href = "/dashboard";
    });
});


$('form[name="form__rangkumankonseling"').submit(function(e){
    e.preventDefault();
    toastr.options = conf.toastr.options.saving
    toastr.info("", "Menyimpan data");
    axios.post('/services/rangkumankonseling', $(this).serialize()).then((res) => {

        window.location.href="/daftarkonseli"
    })
})


function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

$(document).ready(function(){
    let urlParam = new URLSearchParams(window.location.search);
    let path = window.location.pathname.split("/").pop()
    if(path === "caseconference"){
        if(urlParam.has("id")){
            $(`a[data-value="${urlParam.get('id')}"]`).click()
            if(urlParam.has("open")){
                $('#button__masuk_conference').click();
            }
            // selectedCaseconference = caseconferences.filter((o) => (o.id === parseInt(urlParam.get("id"))))[0];
            // showChat();
        }
    }
    if(path === "daftarkonseli"){
        if(urlParam.has("id")){
            $('#daftarkonseli__'+urlParam.get("id")).click();
            if(urlParam.has("open")){
                $('button[name="personal_information__ruangkonseling"]').click();
            }
        }
    }




})

$('#cari-konseling').keyup(function(){
    const searchVal = $(this).val().toLowerCase();
    let k = konselings;


    const filteredKonseling = k.filter((o, i) => {
        return o.konseli.nama_konseli.toLowerCase().indexOf(searchVal) > -1
    })

    let newHtml = ``;
    filteredKonseling.map((item, index) => {
        newHtml+=`
            <div class="d-flex align-items-center justify-content-between mb-5">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="/avatars/${item.konseli.user.avatar}">
                    </div>
                    <div class="d-flex flex-column">
                        <a id=${"daftarkonseli__"+item.id} href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">${item.konseli.nama_konseli}</a>
                        <span class="text-muted font-weight-bold font-size-sm">${item.chats.length>0?atob(item.chats[0].chat_konseling):''}</span>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-end">
                    <span class="text-muted font-weight-bold font-size-sm"></span>
                </div>
            </div>
        `
    })
    $('#konseli-wrapper').html(newHtml)
})

$('form[name="form__rekam_konseling"]').submit(function(e){

    e.preventDefault();
    toastr.options = conf.toastr.options.saving
    toastr.info("", "Menyimpan data");
    axios.post('/services/rekamkonseling', $(this).serialize()).then((res)=>{
        window.location.reload();
    })
})

$(document).ready(function(){
    var sessionLifetime = 60*5;
    let isPopupShow = false;
    $('.kt_app_chat_toggle').click(function(){
        $('#kt_app_chat_toggle').click()
    });

    $(document).click(function(e){
        sessionLifetime = 60*5;
    })

    setInterval(function(){
        sessionLifetime-=1;
        if(sessionLifetime<24 && isPopupShow == false){
            isPopupShow = true
            let timerInterval;
            Swal.fire({
                title: 'Sesi anda akan segera habis<br><b></b>',
                text: 'Apakah anda ingin memperpanjang sesi?',
                html: `<div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                  <b>24</b>
                </div>
              </div>`,
                allowOutsideClick: false,
                allowEscapeKey: false,
                icon: 'warning',
                timerProgressBar: true,
                timer: 24000,
                confirmButtonText: 'Perpanjang Sesi',
                didOpen: () => {
                    timerInterval = setInterval(() => {
                        const content = Swal.getContent()
                        if (content) {
                            const b = content.querySelector('.progress-bar')
                            if (b) {
                                b.textContent = Math.floor(Swal.getTimerLeft()/1000)
                                $('.progress-bar').css('width', ((Math.floor(Swal.getTimerLeft()/1000)/24)*100)+"%")
                                if(Math.floor(Swal.getTimerLeft()/1000)<1){
                                    window.location.href = "/logout";
                                }
                            }
                        }
                    }, 1000)
                }
            }).then((result) => {
                if(result.value){
                    sessionLifetime = 60*5;
                    isPopupShow = false
                }
            })
        }
    },1000)

})

