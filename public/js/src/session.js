$(document).ready(function(){
    var sessionLifetime = 60*5;
    let isPopupShow = false;

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
