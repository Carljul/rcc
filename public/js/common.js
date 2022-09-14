$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    // field validators
    function onlyNumbers(value)
    {
        return value.replaceAll(/[^.0-9]+/g, "")
    }

    function limitDots(value, limit = 1) {
        let occur = 0
        if (value.replace(/[^.]/g, '').length > limit) {
            return value.replace(/[.]/g, match => ++occur > limit ? '' : match)
        }

        return value
    }

    function maxLength(value, max)
    {
        return value.substr(0,max)
    }

    // validation implementations
    // deceased form
    $('#deceasedForm #amount').on('input', (e) => {
        let val = $(e.target).val()
        val = limitDots(val, 1)
        $(e.target).val(onlyNumbers(val))
    })

    $('#deceasedForm #balance').on('input', (e) => {
        let val = $(e.target).val()
        val = limitDots(val, 1)
        $(e.target).val(onlyNumbers(val))
    })

    // lighting form
    $('#lightingForm #amount').on('input', (e) => {
        let val = $(e.target).val()
        val = limitDots(val, 1)
        $(e.target).val(onlyNumbers(val))
    })

    // payment form
    $('#paymentForm #payment_amount').on('input', (e) => {
        let val = $(e.target).val()
        val = limitDots(val, 1)
        $(e.target).val(onlyNumbers(val))
    })

    $('#paymentForm #payment_balance').on('input', (e) => {
        let val = $(e.target).val()
        val = limitDots(val, 1)
        $(e.target).val(onlyNumbers(val))
    })

    // register form
    $('#registerForm #password').on('input', (e) => {
        let val = $(e.target).val()
        val = onlyNumbers(val)
        val = limitDots(val, 0)
        val = maxLength(val, 6)
        $(e.target).val(val)
    })

    $('#registerForm #password-confirm').on('input', (e) => {
        let val = $(e.target).val()
        val = onlyNumbers(val)
        val = limitDots(val, 0)
        val = maxLength(val, 6)
        $(e.target).val(val)
    })
});

function dateFormatter(date) {
    let newDate = new Date(date);
    let day = newDate.getDate();
    let month = newDate.getMonth() + 1;
    let year = newDate.getFullYear();
    let resultDate = year+'-'+month+'-'+day;

    return resultDate == 'NaN-NaN-NaN' ? null : resultDate;
}

function stringFormatter(str) {
    return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
        return letter.toUpperCase();
    });
}
