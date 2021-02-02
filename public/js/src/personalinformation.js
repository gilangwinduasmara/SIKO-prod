function showPersonalInformationById(id){
    if(id!=null){
        $('.empty-state').hide();
    }
    window.clearInterval(window.chatInterval);
    $.each(konselings, function(i, konseling){
        if(konseling.id===id){
            $("#personal_information__"+konseling.id).show();
        }else{
            $("#personal_information__"+konseling.id).hide();
        }
    })
}
$(document).ready(function(){
    $("#personal_information__"+selectedKonseling).show();
})
$.each(konselings, function(i, konseling){
    $("#table_list").on("click", '#daftarkonseli__'+konseling.id, function(){
        selectedKonseling = konseling.id;
        selectedKonselingDetail = konseling;
        showPersonalInformationById(konseling.id);
        if($('#chat-container').is(':visible')){
            showChat();
        }
    });
})
