var currentChat = null;
$('#button__showpersonalinformation').click(function(){
    showPersonalInformationById(selectedKonseling);
    $('#chat-container').hide();
});

function showChat(){
    $('#messages-box').html("");
    window.clearInterval(window.chatInterval);
    $('#chat-spinner').show();
    try {
        showPersonalInformationById(null);
    }catch (e){

    }
    KTAppChat.init();

    window.chatInterval = setInterval(()=>{
        renderChat().then(()=>{
            $('#chat-spinner').hide();
        });
    }, 2000)
}

function sendChat(message){
    console.log('send chat',message);
    axios.post('/api/chatkonseling', {
        chat_konseling: message,
        konseling_id: selectedKonseling
    }).then(function(res){
        console.log(res);
    }).catch(function(err){
        console.log(err.message);
    });
}

async function renderChat(){
    console.log(selectedKonselingDetail);
    $('#chat__username').text(selectedKonselingDetail.konseli.nama_konseli);
    if(user){
        if(user.role === 'konseli'){
            $('#chat__username').text(selectedKonselingDetail.konselor.nama_konselor);
        }
    }
    let request = await axios.get('/api/chatkonseling?konseling_id='+selectedKonseling);
    if(!request.data.success){
        showPersonalInformationById(selectedKonseling);
        $('#chat-container').hide();
    }
    let chats = request.data.rows;
    console.log(chats);
    let html = "";
    let lastId = null;
    Object.keys(chats).map((timestamp, index) => {
        html+=`
            <div class="d-flex flex-column mb-5 align-items-center">
                <div class="mt-2 rounded p-1 bg-light-warning text-dark-50 font-weight-bold font-size-sm text-left max-w-400px">${timestamp}</div>
            </div>
        `;
        chats[timestamp].map((chat, index) => {
            console.log(chat.userID,userId);
            if(chat.userID === userId.toString()){
                html+=`
                    <div class="d-flex flex-column mb-5 align-items-end">
                        <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px d-flex align-items-end">
                            <div>
                                ${atob(chat.chat_konseling)}
                            </div>
                            <div class="text-muted font-size-sm ml-2 d-flex align-items-end">${moment(chat.created_at).format("hh:mm:ss")}</div>
                        </div>
                    </div>`;
            }else{
                html+=`
                    <div class="d-flex flex-column mb-5 align-items-start">
                            <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px d-flex align-items-end">
                            <div>
                                ${atob(chat.chat_konseling)}
                            </div>
                            <div class="text-muted font-size-sm ml-2 d-flex align-items-end h-100">${moment(chat.created_at).format("hh:mm:ss")}</div>
                            </div>
                    </div>`;
            }
            lastId = chat.id;
        });
    });
    $('#messages-box').html(html);
    if(currentChat!==lastId){
        console.log('scroll')
        $('.scroll').scrollTop($('#messages-box').height());
    }
    currentChat = lastId;
}
