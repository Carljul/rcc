$(document).ready(() => {
    $('input#password').focus();

    $('#password').on('input', (e) => {
        let pass = e.target.value.substr(0,6);

        pass = pass.replaceAll(/[^0-9]+/g, "")

        $(e.target).val(pass)

        // submit form when input reach 6
        if (pass.length >= 6) {
            $('#login-form').submit()
        }

        $('.pass-dots').css({'background-color': 'white'})

        $('.pass-dots').each((index, element) => {
            if (pass.length > index) {
                $(element).css({'background-color': '#867f7f'})
            }

            // clear the background if no inputs
            if (pass.length <= 0) {
                $('.pass-dots').css({'background-color': 'white'})
            }
        })
    })

    $('#confirm-button').click((e) => {
        let email = $('#new-email').val()
        $('#new-email').val('')

        $('#form-email').text(email)
        $('#email').val(email)

        $('.input-email-cont').addClass('d-none')
        $('.times').removeClass('d-none')
        $('#form-email').removeClass('d-none')

        // focus the pass input
        $('input#password').focus();
    })

    $('.times').on('click', (e) => {
        $('.input-email-cont').removeClass('d-none')
        $(e.target).addClass('d-none')
        $('#form-email').addClass('d-none')
    })
})
