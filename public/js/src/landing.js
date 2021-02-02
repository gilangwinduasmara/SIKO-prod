let state = {
    selectedRole: 'konseli'
};
function readImage(input) {
    if ( input.files && input.files[0] ) {
        var FR= new FileReader();
        FR.onload = function(e) {
            $('#img-avatar').attr( "src", e.target.result );
            $('[name="avatar"').val(e.target.result)
        };
        FR.readAsDataURL( input.files[0] );
    }
}



$(document).ready(function(){

    const animationSpeed = 5000;
    const animationInOut = 500;

    function showSlide(currentDisplay){
        $('.text-slide-container > .text-slide-item').each(function(index){

            $('.text-slide-item').css('margin-left','-2500px');
            $(this).show();
            $(this).animate({marginLeft: [0, 'swing']})
            $(this).animate({opacity: '1'})
            if(currentDisplay == index){
                $('.text-slide-item').css('margin-left','0');
                setTimeout(()=>{
                    $(this).animate({marginLeft: '3500px'})
                }
                ,animationSpeed-animationInOut)
            }else{
                $(this).hide();
            }
        })
        return  ((currentDisplay+1) % $('.text-slide-container').children().length)
    }

    let currentDisplay = 0;

    $('.text-slide-item').hide();

    currentDisplay = showSlide(currentDisplay)
    setInterval(()=>{
        currentDisplay = showSlide(currentDisplay)
    }, animationSpeed)

    $('#checkbox__agree').change(function(){
        $('#button__setuju').attr('disabled', !$('#checkbox__agree').is(':checked'))
    })

    // $('#modal__persetujuan').modal('show')

    $('#button__lanjut').click(function(){
        let error = false
        if($('#select__gender').val() == ""){
            $('#select__gender + span').text("Jenis kelamin belum dipilih")
            error = true
        }else{
            $('#select__gender + span').text("")
        }
        if($('#select__agama').val() == ""){
            $('#select__agama + span').text("Agama belum dipilih")
            error = true
        }else{
            $('#select__agama + span').text("")
        }
        if($('#input__suku').val() == ""){
            $('#input__suku + span').text("Suku belum dipilih")
            error = true
        }else{
            $('#input__suku + span').text("")
        }
        if($('#input__alamat').val() == ""){
            $('#input__alamat + span').text("Alamat belum diisi")
            error = true
        }else{
            $('#input__alamat + span').text("")
        }
        if($('#input__nama').val() == ""){
            $('#input__nama + span').text("Nama belum diisi")
            error = true
        }else{
            $('#input__nama + span').text("")
        }
        if($('#input__nohp').val() == ""){
            $('#input__nohp + span').text("Nomor hp belum diisi")
            error = true
        }else{
            $('#input__nohp + span').text("")
        }
        if($('#input__nohp_kerabat').val() == ""){
            $('#input__nohp_kerabat + span').text("Nomor hp kerabat belum diisi")
            error = true
        }else{
            $('#input__nohp_kerabat + span').text("")
        }
        if($('#select__hubungan').val() == ""){
            $('#select__hubungan + span').text("Hubungan belum diisi")
            error = true
        }else{
            $('#select__hubungan + span').text("")
        }
        if($('#input__tanggallahir').val() == ""){
            $('#input__tanggallahir + span').text("Tanggal lahir belum dipilih")
            error = true
        }else{
            $('#input__tanggallahir + span').text("")
        }

        if(error)
            return false;

        $('#if__nama').text('   : '+$('#input__name').val())
        $('#if__jk').text('   : '+$('#select__gender').val()).val();
        $('#if__alamat').text('   : '+$('#input__alamat').val()).val();
        $('#if__nama').addClass('pl-6')
        $('#if__jk').addClass('pl-6')
        $('#if__alamat').addClass('pl-6')
        $('#modal__register').modal('hide')
        $('#modal__persetujuan').modal('show');
        return false
    })


    $('#button__setuju').click(function(){
        $('#form__register').submit();
    })

    $('#button_foto').click(function(){
        $('#input_file').click()
    })
    $('#input_file').change(function(){
        readImage(this);
    });
    $('.owl-carousel').owlCarousel({
        items: 4,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            800: {
                items: 2,
                nav: true
            },
            900: {
                items: 3,
                nav: true
            },
            1000: {
                items: 4,
                nav: true
            },
        }
    });

    $('#button__login').click(function(){
        $('#modal__login').modal('show');
    });

    $('.role-select > a').click(function(){
        changeSelectedRole();
    });

    $('#form__login').submit(function(e){
        e.preventDefault();
        toastr.options = conf.toastr.options.saving;
        toastr.info("Sedang memproses data")
        const url = state.selectedRole === 'konselor' ? '/services/auth/login' : '/services/auth/siasat';
        axios.post(url, $(this).serialize()).then((response) => {
            if(response.data.success){
                if(response.data.action !== 'register'){
                    window.location.href = "/dashboard";
                }else{
                    const data = response.data.data;
                    $('#modal__register').modal('show');
                    $('#modal__login').modal('hide');
                    $('#input__nama').val(data.nama);
                    $('#input__name').val(data.nama);
                    $('#input__nim').val(data.nim);
                    $('#input__nohp').val(data.nohp);
                    $('#input__prodi').val(data.progdi);
                    $('#input__fakultas').val(data.fakultas);
                    $('#input__email').val(data.email);
                }
            }else{
                toastr.clear()
                toastr.options = conf.toastr.options.saving;
                toastr.error(response.data.message, "Login gagal!")
            }
        });
    });

    $('<span class="text-danger"></span>').insertAfter('input')
    $('<span class="text-danger"></span>').insertAfter('select')

    $('#form__register').submit(function (e){
        e.preventDefault();

        toastr.options = conf.toastr.options.saving
        toastr.info("Sedang memproses data")

        axios.post('/services/auth/register', $(this).serialize()).then(res => {
            if(res.data.success){
                $('#modal__login').modal('show');
                $('#modal__register').modal('hide');
                $('#modal__persetujuan').modal('hide');
            }else{

            }
        });
    });

});

$(document).ready(function(){
    $('#radio__m').click(function(){
        $('#login-email').attr("placeholder", "NIM")
    })
    $('#radio__d').click(function(){
        $('#login-email').attr("placeholder", "NIP")
    })
    $('#input__tanggallahir').attr({"max": new Date().toISOString().split("T")[0]})
})

function changeSelectedRole(){
    var roleEl = $('.role-select .role');
    var activeRoleEl = $('.role-select .active-role');
    $('.role-select .active-role').attr('class', 'role');

    if(state.selectedRole === 'konseli'){
        stopThrottleCheck();
        $('#login-email').attr("placeholder", "Email")
        state.selectedRole = 'konselor';
        $('.radio-role').hide()
        $('#toggle__selected').addClass('is-konselor-selected');
    }else{
        $('#login-email').attr("placeholder", "NIM")
        state.selectedRole = 'konseli';
        $('#radio__m').click();
        $('.radio-role').show()
        $('#toggle__selected').removeClass('is-konselor-selected');
        throttleCheck();
    }
    $('input[name="role"]').attr('value', state.selectedRole);
    $('#toggle__selected').text(state.selectedRole);

    activeRoleEl.attr('class', 'role');
    roleEl.attr('class', 'active-role');
}


