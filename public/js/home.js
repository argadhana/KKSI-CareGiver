$( document ).ready(function() {
    $('#button-pesan').click(function(e) {
        vProfile()
    });
});

function vProfile() {
    $('.inicard').addClass("d-none");
    $('#content-app').load("/pesan");
    console.log('aaaaaaaaaaaaaa')
}

