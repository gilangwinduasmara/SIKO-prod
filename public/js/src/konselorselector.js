
let jadwalKonselor= {};
var selectedJadwal= null;
var selectedKonselor= null;

let days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

function onJadwalSelected(id){
    selectedJawdal = id;
    console.log(id)
    $('#input__jadwal_konselor_id').val(id);
    $('#button__daftar_sesi').attr('disabled', false);
    $('#button__daftar_sesi_referral').attr('disabled', false);
}

function initHari(){
    $.each(days, function(index, hari){
        $('#list_hari__'+hari).click(function (){
            console.log('hari')
            let aEl = $($(this).children()[0]);
            console.log(aEl)
            if(aEl.data('toggle') === 'pill'){
                $('#button__daftar_sesi').attr('disabled', true);
                console.log(aEl.data('value'));
                const selectedJadwalKonselor = jadwalKonselor[aEl.data('value')];
                let html = "";
                selectedJadwalKonselor.map((jadwal, index) => {
                    html +=`
                    <li data-value=${jadwal.id} onclick="onJadwalSelected(${jadwal.id})" class="card card-custom nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a class="nav-link py-2 d-flex rounded flex-column align-items-center" data-toggle="pill"  href="#jadwal">
                            <span class="font-size-sm py-2 font-weight-bold text-center">${jadwal.jam_mulai+":00-"+jadwal.jam_akhir+":00"}</span>
                        </a>
                    </li>
                `;
                });
                $('#ul__days_selector').html(html);
            }
        });
    });
}

$(document).ready(function(){
    initHari();
    $('#chat-container').hide();
})

$.each(konselors, function(index, konselor){
    $('#daftarkonselor__'+konselor.id).click(function(){
       console.log(konselor.id);
    });
    $("#table_list").on("click", '#daftarkonselor__'+konselor.id, function(){
        $('#chat-container').show();
        $('.empty-state').hide();

        renderJadwalSelector(konselor.id);
        $('#selected_konselor').text(konselor.nama_konselor)
        $('#button__daftar_sesi_referral').attr('disabled', true);
        $('#button__daftar_sesi').attr('disabled', true);
        $('#input__konselor_id').val(konselor.id);
    });
});

$('#form_daftar_sesi').submit(function(e){
    e.preventDefault();
    console.log($(this).serialize());
    axios.post('/services/konseling', $(this).serialize()).then(res => {
        console.log(res.data);
        if(res.data.success){
            window.location.href="/dashboard";
        }else{
            Swal.fire({
                title: '',
                text: res.data.error
            }).then(function(result){
                if(result.value){
                    if(res.data.redirect){
                        window.location.href = res.data.redirect
                    }
                }
            })
        }
    });
});

function renderJadwalSelector(konselor_id){
    resetState();
    $('.active').removeClass('active')
    $('#ul__days_selector').html("");
    axios.get('/services/jadwalkonselor?konselor_id='+konselor_id).then(res => {
        jadwalKonselor = res.data.data;
        console.log(Object.keys(res.data.data));
        Object.keys(res.data.data).map((hari, index) => {
            $('#day_item__'+hari).attr('data-toggle', 'pill');
            $($('#day_item__'+hari).children()[0]).addClass('text-dark');
        });
    });
}

function resetState(){
    days.map((hari, index) => {
        $('#day_item__'+hari).attr('data-toggle', '');
        $($('#day_item__'+hari).children()[0]).removeClass('text-dark');
    });
}
