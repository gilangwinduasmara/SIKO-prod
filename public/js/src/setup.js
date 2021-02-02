$('#checkbox__persetujuan').change(function(){
    $('#button__ask_case_conference').attr('disabled', !$('#checkbox__persetujuan').is(':checked'));
    $('#button__ask_referral').attr('disabled', !$('#checkbox__persetujuan').is(':checked'));
});


