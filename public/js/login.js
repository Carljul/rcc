$(document).ready(() => {

    /*======================================================================
     * DOM Manipulation
     *======================================================================*/

    $('input#password').focus();

    $(document).click(() => $('input#password').focus());

    $('#login-form').keyup((e) => {
        if (e.which == 13) {
            reflectEmail(e)
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

    $('#confirm-button').click(reflectEmail)

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


    /*======================================================================
     * Method
     *======================================================================*/

    /**
     * Reflect new email value
     * @param {*} e
     * @returns
     */
    function reflectEmail(e) {
        e.stopPropagation()

        let email = $('#new-email').val()

        if (email.length) {
            $('#form-email').text(email)
            $('#email').val(email)

            if (!isEmail(email)) {
                $('#new-email').parent().find('#invalid-email').addClass('d-block')
                $('#new-email').val(email)
                setTimeout(() => {
                    $('#new-email').parent().find('#invalid-email').removeClass('d-block')
                }, 2000)
                return
            }
        }

        $('#new-email').val('')
        $('.input-email-cont').addClass('d-none')
        $('.times').removeClass('d-none')
        $('#form-email').removeClass('d-none')

        // focus the pass input
        $('input#password').focus();
    }

    /**
     * Check string if email
     */
    function isEmail(email) {
        const regexPatt = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regexPatt.test(email);
    }

})
