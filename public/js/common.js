$(document).ready(function () {
    // field validators
    function onlyNumbers(value)
    {
        return value.replaceAll(/[^0-9]+/g, "")
    }

    function maxLength(value, max)
    {
        return value.substr(0,max)
    }

    // validation implementations
    // deceased form
    $('#deceasedForm #amount').on('input', (e) => {
        let val = $(e.target).val()
        $(e.target).val(onlyNumbers(val))
    })

    // lighting form
    $('#lightingForm #amount').on('input', (e) => {
        let val = $(e.target).val()
        $(e.target).val(onlyNumbers(val))
    })

    // register form
    $('#registerForm #password').on('input', (e) => {
        let val = $(e.target).val()
        val = onlyNumbers(val)
        val = maxLength(val, 6)
        $(e.target).val(val)
    })

    $('registerForm #password-confirm').on('input', (e) => {
        let val = $(e.target).val()
        val = onlyNumbers(val)
        val = maxLength(val, 6)
        $(e.target).val(val)
    })
});
