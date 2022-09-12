

var uploadFile = function() {
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
        middlename: typeof(data[0].middlename) != 'undefined' ? data[0].middlename : null,
        lastname: typeof(data[0].lastname) != 'undefined' ? data[0].lastname : null,
        extension: typeof(data[0].extension) != 'undefined' ? data[0].extension : null,
        gender: typeof(data[0].gender) != 'undefined' ? (data[0].gender).toLowerCase() == 'female' ? 1:0:null,
        birthdate: typeof(data[0].birthdate) != 'undefined' ? dateFormatter(data[0].birthdate) : null,
        address:  typeof(data[0].address) != 'undefined' ? data[0].address : null,
        dateDied:  typeof(data[0].date_died) != 'undefined' ? dateFormatter(data[0].date_died) : null,
        internmentDate:  typeof(data[0].date_internment) != 'undefined' ? dateFormatter(data[0].date_internment) : null,
        internmentTime:  typeof(data[0].date_internment) != 'undefined' ? data[0].time_internment : null,
        expiryDate:  typeof(data[0].expiry_date) != 'undefined' ? dateFormatter(data[0].expiry_date) : null,
        cod:  typeof(data[0].cause_of_death) != 'undefined' ? data[0].cause_of_death : null,
        location:  typeof(data[0].location) != 'undefined' ? data[0].location : null,
        vicinity:  typeof(data[0].vicinity) != 'undefined' ? data[0].vicinity : null,
        area:  typeof(data[0].area) != 'undefined' ? data[0].area : null,
        payer:  typeof(data[0].payer) != 'undefined' ? data[0].payer : null,
        contact_number:  typeof(data[0].contact_number) != 'undefined' ? data[0].contact_number : null,
        payment_type:  1,
        amount:  typeof(data[0].amount) != 'undefined' ? data[0].amount : null,
        ornumber:  typeof(data[0].or_number) != 'undefined' ? data[0].or_number : null,
        balance:  typeof(data[0].balance) != 'undefined' ? data[0].balance : null,
        terms_of_payment:  typeof(data[0].terms_of_payment) != 'undefined' ? data[0].terms_of_payment : null,
        datepaid:  typeof(data[0].date_paid) != 'undefined' ? dateFormatter(data[0].date_paid) : null,
        remarks:  typeof(data[0].remarks) != 'undefined' ? data[0].remarks : null,
        pasuga_payer:  typeof(data[0].pasuga_payer) != 'undefined' ? data[0].pasuga_payer : null,
        pasuga_date_connection:  typeof(data[0].pasuga_date_connection) != 'undefined' ? dateFormatter(data[0].pasuga_date_connection) : null,
        pasuga_expiry_date:  typeof(data[0].pasuga_expiry_date) != 'undefined' ? dateFormatter(data[0].pasuga_expiry_date) : null,
        pasuga_amount:  typeof(data[0].pasuga_amount) != 'undefined' ? data[0].pasuga_amount : null,
        pasuga_or_number:  typeof(data[0].pasuga_or_number) != 'undefined' ? data[0].pasuga_or_number : null,
        is_approve: 1
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
            data.shift();
            let shifted = {
                'id': file.id,
                'name': file.name,
                'data': data
            };
            localStorage.setItem('extracting', JSON.stringify(shifted));
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
