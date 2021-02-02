

var hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']

function displayDaftarKonselingByHari(target){
    $('.dropdown-daftarkonseling').text(target)
    $.each(hari, function(i, v){
        if(target !== v){
            $('#jadwal__'+v).hide();
        }else{
            $('#jadwal__'+v).show();
        }
    });
}

$.each(hari, function(i, item){
    $("#daftarkonseling__hari_"+item).click(function(){
        displayDaftarKonselingByHari(item);
    });
    // default hari untuk daftar konseling
    displayDaftarKonselingByHari('Senin')
})

function refreshNotification(){
    axios.get('/services/notification').then(res=>{
        let notifHtml = '';
        let chatHtml = '';
        $('#dropdown-chat').html("")
        $('#dropdown-notif').html("")
        $('.clear-notif').hide();
        $('.clear-chat').hide();
        res.data.rows.map((item, index) => {
            if(item.type === 'chat' || item.type === 'chat_conference'){
                $('[name="chat-badge"]').show();
                chatHtml +=`
                <li class="navi-item">
                    <a href=${"/notification/"+item.id} class="navi-link">
                        <div class="navi-text">
                            <div class="font-weight-bold">${item.title}</div>
                            <div class="d-block text-muted text-truncate" style="max-width: 140px">${item.message}</div>
                            <div class="font-size-xs text-right">${item.timestamp}</div>
                        </div>
                    </a>
                </li>
                `;
                $('.clear-chat').show();
                $('[name="dropdown-chat"]').html(chatHtml)
            }else{
                $('[name="notif-badge"]').show();
                notifHtml +=`
                <li class="navi-item">
                    <a href=${"/notification/"+item.id} class="navi-link">
                        <div class="navi-text">
                            <div class="font-weight-bold">${item.title}</div>
                            <div class="text-muted">${item.message}</div>
                            <div class="font-size-xs text-right">${item.timestamp}</div>
                        </div>
                    </a>
                </li>
                `;

                $('.clear-notif').show();
                $('[name="dropdown-notif"]').html(notifHtml)
            }
            if($('.notif-scroll').length > 0){
                const ps = new PerfectScrollbar('.notif-scroll')
                ps.update()
            }
        })
    })
}

$(document).ready(function(){




    let notifCount = 0;
    let chatCount = 0;
    refreshNotification();

    setInterval(()=>{
        refreshNotification();
    }, 40000)

})
