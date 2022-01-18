$(document).ready(function() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = $('.needs-validation');

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    $('.err-msg')
                    .removeClass( "d-none" )
                    .addClass( "d-flex")
                    .addClass( "justify-content-center" )
                    .addClass( "text-center" );
                    $('.err-msg').focus();
                }

                $(this).addClass('was-validated');
            }, false)
        })
});