$(document).ready(() => {
    $('input#password').focus();

    $(document).click(() => $('input#password').focus());

    $('#login-form').keyup((e) => {
        if (e.which == 13) {
            $('#login-form').submit()
        }
    })

    // password
    $('#password').on('input', (e) => {
        e.stopPropagation()

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

    $('#new-email').click((e) => {
        e.stopPropagation()
    })

    $('#confirm-button').click((e) => {
        e.stopPropagation()

        let email = $('#new-email').val()
        $('#new-email').val('')

        if (email.length) {
            $('#form-email').text(email)
            $('#email').val(email)
        }

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

    // For change pin
    $('.change-pin-input').on('input', (e) => {
        let val = $(e.target).val()
        val = val.replaceAll(/[^0-9]+/g, "")
        val = val.substr(0,6)

        $(e.target).val(val)
    })
})
