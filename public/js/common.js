$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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

window.uploadFile = function() {
    if (localStorage.getItem('excels') != null) {
        let excels = JSON.parse(localStorage.getItem('excels'));
        if (excels.length > 0) {
            $('#import-nav').html(`Import <span class="translate-middle badge rounded-pill bg-danger">
            `+excels.length+`
            <span class="visually-hidden">unread messages</span>
          </span>`);
            if (localStorage.getItem('extracting') === null) {
                localStorage.setItem('extracting', JSON.stringify(excels[0]));
            }
            setTimeout(function() {
                extractFile();
            }, 1000);
        } else {
            localStorage.removeItem('excels');
            localStorage.removeItem('extracting');
            $('#import-nav span.badge').remove();
            $('#drop-area').removeClass('hide');
            $('#progress-area').addClass('hide');
        }
    }
}

uploadFile()

function extractFile() {
    if (localStorage.getItem('extracting') != null) {
        let file = JSON.parse(localStorage.getItem('extracting'));
        let data = file.data;
        $('tr#'+file.id+' td.import-progress').html('Processing! '+data.length+' data left to upload');
        savingRecord(file)
    }
}

function savingRecord(file)
{
    let data = file.data;
    let toInsert = {
        firstname: data[0].firstname,
        middlename: data[0].middlename,
        lastname: data[0].lastname,
        extension: data[0].extension,
        gender: data[0].gender,
        birthdate: data[0].birthdate,
        address: data[0].address,
        dateDied: data[0].date_died,
        internmentDate: data[0].date_internment,
        internmentTime: data[0].time_internment,
        expiryDate: data[0].expiry_date,
        cod: data[0].cause_of_death,
        location: data[0].location,
        amount: data[0].amount,
        ornumber: data[0].or_number,
        datepaid: data[0].date_paid,
        relativeFirstname: data[0].relative_firstname,
        relativeMiddlename: data[0].relative_middlename,
        relativeLastname: data[0].relative_lastname,
        relativeContactNumber: data[0].relative_contact_number,
        remarks: data[0].remarks,
        pasuga_payer: data[0].pasuga_payer,
        pasuga_date_connection: data[0].pasuga_date_connection,
        pasuga_expiry_date: data[0].pasuga_expiry_date,
        pasuga_amount: data[0].pasuga_amount,
        pasuga_or_number: data[0].pasuga_or_number,
    };
    $.ajax({
        type: 'POST',
        url: '/deceased',
        data: toInsert,
        success: function (response) {
            data.shift();
            if(data.length > 0) {
                let shifted = {
                    'id': file.id,
                    'name': file.name,
                    'data': data
                };
                localStorage.setItem('extracting', JSON.stringify(shifted));
            } else {
                localStorage.removeItem('extracting');
                let excels = JSON.parse(localStorage.getItem('excels'));
                let removeRow = excels[0].id;
                excels.shift();
                localStorage.setItem('excels', JSON.stringify(excels));
                $('#'+removeRow).remove();
            }
            uploadFile()
        }, error: function(e) {
            if (localStorage.getItem('withIssues') === null) {
                localStorage.setItem('withIssues', JSON.stringify([toInsert]));
            } else {
                let withIssues = JSON.parse(localStorage.getItem('withIssues'));
                withIssues.push(toInsert);
                localStorage.setItem('withIssues', JSON.stringify(withIssues));
            }
            uploadFile()
        }
    })
}
