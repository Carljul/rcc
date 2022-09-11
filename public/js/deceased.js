$(document).ready(function() {
    generateTable();
    function generateTable() {
        let table = $('#deceasedTable').DataTable();
        table.destroy()
        $.ajax({
            type: 'GET',
            url: '/deceased/list/all',
            success: function (response) {
                let data = response.data;
                let html = '';
                for (let i = 0; i < data.length; i++) {
                    const element = data[i];
                    let name = element['person']['firstname']+` `+(element['person']['middlename'] == null ? '':element['person']['middlename'])+` `+element['person']['lastname']+` `+(element['person']['extension'] == null ? '' : element['person']['extension']);
                    html += `<tr>
                        <td>`+name+`</td>
                        <td>`+(element['dateDied'] == null ? '' : element['dateDied'])+`</td>
                        <td>`+(element['expiryDate'] == null ? '' : element['expiryDate'])+`</td>
                        <td>`+(element['location'] == null ? '' : element['location'])+`</td>
                        <td><button class="btn btn-success btn-edit" data-id="`+element['id']+`"><i class="fa fa-eye white" aria-hidden="true"></i></button>
                        <button class="btn btn-warning btn-ligthings" data-id="`+element['id']+`"><i class="fa fa-lightbulb-o white" aria-hidden="true"></i></button>
                        <button class="btn btn-danger btn-delete" data-id="`+element['id']+`" data-name="`+name+`"><i class="fa fa-trash white" aria-hidden="true"></i></button>
                        <button class="btn btn-primary btn-print" data-id="`+element['id']+`"><i class="fa fa-print white" aria-hidden="true"></i></button>
                        <button class="btn btn-info btn-approve" data-id="`+element['id']+`" data-name="`+name+`"><i class="fa fa-thumbs-o-up white" aria-hidden="true"></i></button>
                        </td>
                    </tr>`;
                }
                $('#deceasedTable tbody').html(html);
                $('#deceasedTable').dataTable({
                    "aaSorting": [],
                    "columns": [
                        { "width": "20%" },
                        null,
                        null,
                        { "width": "25%" },
                        { "width": "24%" }
                    ]
                });


                viewRecord();
                deleteModal();
                lightingButton();
                printingRecord(response.reports);
                approveRecord();
            }, error: function (e) {
                console.log(e);
            }
        })
    }
    function lightingButton() {
        $(document).on('click', '.btn-ligthings', function () {
            let id = $(this).data('id');
            lightingRecord(id);
        });
    }
    function approveRecord()
    {
        $(document).on('click', '.btn-approve', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#approveDeceasedModalBody p').html('Are you sure you want to update approve status of '+name+'\'s record?');
            $('#formDeceasedApproval').attr('action', 'deceased/approval/'+id);
            $('#approveDeceasedModal').modal('show');
        });
    }

    function deleteModal()
    {
        $(document).on('click', '.btn-delete', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#deleteModal #deleteModalBody p').html('Are you sure you want to delete the record of '+name+'?');
            $('#deleteModal #formDelete #deleteId').val(id);
            $('#deleteModal').modal('show');
        });
    }

    function viewRecord()
    {
        $(document).on('click', '.btn-edit', function () {
            let id = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: 'deceased/'+id,
                success: function (response) {
                    let data = response.data;
                    let payment = data.payment;
                    $('#detailModalBody form#updateFormDeceased')[0].reset();
                    $('#detailModalBody form#updateFormDeceased').attr('action', 'deceased/'+data.id)
                    $('#viewfirstname').val(data.person.firstname);
                    $('#viewmiddlename').val(data.person.middlename);
                    $('#viewlastname').val(data.person.lastname);
                    $('#viewextension').val(data.person.extension);
                    $('#viewgender').val(data.person.gender).change();
                    $('#viewbirthdate').val(data.person.birthdate);
                    $('#viewaddress').val(data.person.address);
                    $('#viewdateDied').val(data.dateDied);
                    $('#viewinternmentDate').val(data.internmentDate);
                    $('#viewinternmentTime').val(data.internmentTime);
                    $('#viewexpiryDate').val(data.expiryDate);
                    $('#viewcod').val(data.causeOfDeath);
                    $('#viewlocation').val(data.location);
                    $('#viewVicinity').val(data.vicinity);
                    $('#viewArea').val(data.area);
                    $('#viewRemarks').val(data.remarks);
                    $('#deceasedPerson').val(data.id);

                    if (data.approved_by != null) {
                        $('#isApprove').html('Record was approved by '+data.approved_by.name);
                    } else {
                        $('#isApprove').html('Record still needs approval');
                    }

                    if (!isArray(payment)) {
                        payment = [payment];
                    }

                    paymentList(payment);

                    $('#recordLogCreated').html('Record was created last <strong>'+dateTimeFormatter(data.created_at)+'</strong>');
                    $('#recordLogUpdated').html('Record was updated last <strong>'+dateTimeFormatter(data.updated_at)+'</strong>');

                    $('#detailModal').modal('show');
                }, error: function (error) {
                    console.log(error);
                }
            });
        });
    }
    let isArray = function(a) {
        return (!!a) && (a.constructor === Array);
    };

    function paymentList(payment)
    {
        let html = '';
        for (let i = 0; i < payment.length; i++) {
            const element = payment[i];
            html+= `<tr>
                <td>`+(element['payer'] ?? '')+`</td>
                <td>`+(element['contact_number'] ?? '')+`</td>
                <td>`+(element['amount'] ?? '')+`</td>
                <td>`+(element['balance'] ?? '')+`</td>
                <td>`+(element['ORNumber'] ?? '')+`</td>
                <td>`+(element['terms_of_payment'] ?? '')+`</td>
                <td>`+(element['datePaid'] ?? '')+`</td>
                <td>
                    <button class="btn btn-small btn-success btn-payment" data-payment-id="`+element['id']+`">Modify</button>
                </td>
            </tr>`;
        }

        $('#amountTable tbody').html(html);
        $('#amountTable').dataTable();
        paymentButton();
    }

    function paymentButton()
    {
        $('.btn-payment').on('click', function() {
            let id = $(this).data('payment-id');
            $.ajax({
                type: 'GET',
                url: '/payment/'+id+'/edit',
                success: function (response) {
                    let data = response.data;
                    $('#payment_payment_type').val(data.payment_type).change();
                    $('#payment_payer').val(data.payer);
                    $('#payment_contact_number').val(data.contact_number);
                    $('#payment_amount').val(data.amount);
                    $('#payment_balance').val(data.balance);
                    $('#payment_ornumber').val(data.ORNumber);
                    $('#payment_terms_of_payment').val(data.terms_of_payment);
                    $('#payment_remarks').val(data.remarks);
                    $('#payment_datePaid').val(data.datePaid);
                    $('#paymentForm').append('<input type="hidden" name="_method" value="PUT">');
                    $('#paymentForm').attr('action', '/payment/'+id);
                }, error: function (e) {
                    console.log(e);
                }
            })
        });
    }

    function printingRecord(reports)
    {
        $(document).on('click', '.btn-print', function () {
            let id = $(this).data('id');
            let html = '<p>Sorry no certificate available!</p>';

            $('#formReport')[0].reset();
            $('.reportSelectedText').html('');
            $('#formReport .fields').html('');
            if(reports.length > 0) {
                html ='';
                for (let i = 0; i < reports.length; i++) {
                    const element = reports[i];
                    html += `<div class="col card-contract" data-reporttype="`+element.reportType+`" data-deceased="`+id+`" data-id="`+element.id+`" data-name="`+element.name+`" data-fields="`+element.fields+`">
                            <div class="card">
                                <div class="card-body">
                                    `+element.name+`
                                </div>
                            </div>
                        </div>`;
                }
                $('#formReport').show();
                $('#createPDF').show();
            } else {
                $('#formReport').hide();
                $('#createPDF').hide();
            }

            $('#contractTable').dataTable();
            $('#printModalBody div.row#templates').html(html);
            $('#printingModal').modal('show');

            $('.card-contract').on('click', function () {
                let id = $(this).data('id');
                let deceased_id = $(this).data('deceased');
                let reportType = $(this).data('reporttype');
                let name = $(this).data('name');
                let fields = $(this).data('fields').split(',');

                $('.card-contract .card').removeClass('active');
                $($(this)[0].children[0]).addClass('active');

                $('.reportSelected').val(id);
                $('.reportSelectedText').html(name);

                let html = '';
                if (fields.length > 0) {
                    $('#formReport .fields').html(html);
                    html += '<input type="hidden" name="reportType" value="'+reportType+'" />';
                    html += `<div class="row">`;
                    for (let i = 0; i < fields.length; i++) {
                        let element = fields[i];
                        let name = stringFormatter((element.replace(/_/g, ' ')).replace('field', '').replace('disabled', ''));
                        let dataType = 'text';
                        let fieldDisabled = '';

                        if (element.includes('date')) {
                            dataType = 'date';
                        }

                        if (element.includes('disabled')) {
                            fieldDisabled = 'disabled';
                        }

                        html += `<div class="col-md-6">
                            <label for="`+element+`" class="col-form-label">`+name+`</label>
                            <input id="`+element+`" type="`+dataType+`" class="form-control" name="`+element+`" `+fieldDisabled+`/>
                        </div>`;
                    }
                    html += `</div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button class="btn btn-success">Create</button>
                        </div>
                    </div>`;
                    $('#formReport .fields').html(html);
                }
                // setTimeout(function () {
                    $.ajax({
                        type: 'GET',
                        url: 'deceased/'+deceased_id,
                        success: function (response) {
                            let data = response.data;
                            for (let i = 0; i < fields.length; i++) {
                                let element = fields[i];
                                if (element == 'date_of_death_disabled_field') {
                                    $('#'+element).val(data.dateDied);
                                }
                                if (element == 'internment_date_disabled_field') {
                                    $('#'+element).val(data.internmentDate);
                                }
                                if (element == 'expiry_date_disabled_field') {
                                    $('#'+element).val(data.expiryDate);
                                }
                                if (element == 'location_disabled_field') {
                                    $('#'+element).val(data.location);
                                }
                                if (element == 'vicinity_disabled_field') {
                                    $('#'+element).val(data.vicinity);
                                }
                                if (element == 'area_disabled_field') {
                                    $('#'+element).val(data.area);
                                }

                                if (element == 'lease_amount_disabled_field') {
                                    if (data.payment.length > 0) {
                                        let payments = data.payment;
                                        let selectedPayment = '';
                                        for (let x = 0; x < payments.length; x++) {
                                            const payment = payments[x];
                                            if (payment.payment_type == reportType) {
                                                selectedPayment = payment;
                                                break;
                                            }
                                        }

                                        if (selectedPayment != '') {
                                            $('#'+element).val(selectedPayment.amount);
                                        }
                                    }
                                }

                                if (element == 'receipt_disabled_field') {
                                    if (data.payment.length > 0) {
                                        let payments = data.payment;
                                        let selectedPayment = '';
                                        for (let x = 0; x < payments.length; x++) {
                                            const payment = payments[x];
                                            if (payment.payment_type == reportType) {
                                                selectedPayment = payment;
                                                break;
                                            }
                                        }
                                        if (selectedPayment != '') {
                                            $('#'+element).val(selectedPayment.ORNumber);
                                        }
                                    }
                                }

                                if (element == 'date_paid_disabled_field') {
                                    if (data.payment.length > 0) {
                                        let payments = data.payment;
                                        let selectedPayment = '';
                                        for (let x = 0; x < payments.length; x++) {
                                            const payment = payments[x];
                                            if (payment.payment_type == reportType) {
                                                selectedPayment = payment;
                                                break;
                                            }
                                        }
                                        if (selectedPayment != '') {
                                            $('#'+element).val(selectedPayment.datePaid);
                                        }
                                    }
                                }

                                if (element == 'balance_disabled_field') {
                                    if (data.payment.length > 0) {
                                        let payments = data.payment;
                                        let selectedPayment = '';
                                        for (let x = 0; x < payments.length; x++) {
                                            const payment = payments[x];
                                            if (payment.payment_type == reportType) {
                                                selectedPayment = payment;
                                                break;
                                            }
                                        }
                                        if (selectedPayment != '') {
                                            $('#'+element).val(selectedPayment.balance);
                                        }
                                    }
                                }

                                if (element == 'terms_of_payment_disabled_field') {
                                    if (data.payment.length > 0) {
                                        let payments = data.payment;
                                        let selectedPayment = '';
                                        for (let x = 0; x < payments.length; x++) {
                                            const payment = payments[x];
                                            if (payment.payment_type == reportType) {
                                                selectedPayment = payment;
                                                break;
                                            }
                                        }
                                        if (selectedPayment != '') {
                                            $('#'+element).val(selectedPayment.terms_of_payment);
                                        }
                                    }
                                }

                                if (element == 'remarks_disabled_field') {
                                    if (data.payment.length > 0) {
                                        let payments = data.payment;
                                        let selectedPayment = '';
                                        for (let x = 0; x < payments.length; x++) {
                                            const payment = payments[x];
                                            if (payment.payment_type == reportType) {
                                                selectedPayment = payment;
                                                break;
                                            }
                                        }
                                        if (selectedPayment != '') {
                                            $('#'+element).val(selectedPayment.remarks);
                                        }
                                    }
                                }
                            }
                            $('#formReport').attr('action', '/reports/'+id);
                        }, error: function (e) {
                            console.log(e);
                        }
                    });
                // },1000);
            });

            $('#createPDF').on('click', function () {
                $('#formReport').submit();
            });
        });
    }

    function lightingRecord(id)
    {
        let lightingTable = $('#tableLightings').DataTable();
        lightingTable.destroy();

        $.ajax({
            type: 'GET',
            url: 'lighting/'+id,
            success: function (response) {
                $('#recordOf').html('');
                $('#deceasedPerson').val(0);

                $('#deceasedPerson').val(response.recordOf.id);
                $('#recordOf').html('Record of: '+response.recordOf.person.firstname+' '+response.recordOf.person.lastname);

                let html = '';
                if (response.data != null) {
                    let data = response.data;
                    let today = new Date();
                    for (let i = 0; i < data.length; i++) {
                        const element = data[i];
                        let expiry = new Date(element['expiryDate']);
                        let status = 'Connected';

                        if (today > expiry) {
                            status = 'Expired';
                        }
                        let orNumber = '';
                        if (element['ORNumber'] === 'null') {
                            orNumber = element['ORNumber'];
                        }
                        html += `
                            <tr>
                                <td>`+element['id']+`</td>
                                <td>`+element['name']+`</td>
                                <td>`+element['dateOfConnection']+`</td>
                                <td>`+element['expiryDate']+`</td>
                                <td>Php `+numberWithCommas(element['amount'])+`</td>
                                <td>`+orNumber+`</td>
                                <td>`+status+`</td>
                                <td>
                                    <button class="btn btn-success btn-edit-lighting" data-id="`+element['id']+`" data-deceased-id="`+element['deceased_id']+`"><i data-id="`+element['id']+`" class="fa fa-edit white" aria-hidden="true"></i></button>
                                    <button class="btn btn-danger btn-delete-lighting" data-id="`+element['id']+`" data-deceased-id="`+element['deceased_id']+`"><i class="fa fa-trash white" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        `;
                    }
                }

                $('#tableLightings tbody').html(html);
                $('#tableLightings').dataTable();
                $('#lightingModal').modal('show');

                deleteLightingModal();
            }, error: function (e) {
                console.log(e);
            }
        });
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function deleteLightingModal()
    {
        $('#tableLightings tbody .btn-delete-lighting').on('click', function () {
            let id = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: 'lighting/'+id+'/pasuga',
                success: function (response) {
                    if (response.data != null) {
                        let id = response.data.id;
                        $('#deleteLightingModalBody p').html('Are you sure you want to delete record #'+id);
                        $('#deleteLightingModal #formLightingDelete').attr('action', 'lighting/'+id);
                        $('#deleteLightingModal').modal('show');
                    }
                }, error: function (e) {
                    console.log(e);
                }
            })
        });
    }

    function dateTimeFormatter(date)
    {
        date = new Date(date);
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return (date.getMonth()+1) + "/" + date.getDate() + "/" + date.getFullYear() + "  " + strTime;
    }

    $('#formLightingDelete').on('submit', function (e) {
        e.preventDefault();
        let action = $(this).attr('action');
        $.ajax({
            type: 'DELETE',
            url: action,
            data: $(this).serialize(),
            success: function (response) {
                if (!response.error) {
                    lightingRecord(response.data);
                    $('#deleteLightingModal').modal('hide');
                } else {
                    console.log(e);
                }
            }, error: function (e) {
                console.log(e);
            }
        })
    });

    $('#paymentForm').on('submit', function(e) {
        e.preventDefault();
        let type = 'POST';
        if ($('#paymentForm input[name="_method"]').length > 0) {
            type = 'PUT';
        }
        $.ajax({
            type: type,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                let table = $('#amountTable').DataTable();
                table.destroy();
                let data = response.data;
                $('#paymentForm')[0].reset();
                paymentList(data);
                $('#btn-cancel-payment').trigger('click');
            }, error: function (e) {
                console.log(e);
            }
        })
    });

    $('#btn-cancel-payment').on('click', function(e) {
        e.preventDefault();
        if ($('#paymentForm input[name="_method"]').length > 0) {
            $('#paymentForm')[0].reset();
            $('#paymentForm input[name="_method"]').remove();
            $('#paymentForm').attr('action', '/payment');
        }
    });


    $('#formDelete').on('submit', function (e) {
        e.preventDefault();
        let id = $('#formDelete input#deleteId').val();
        $.ajax({
            type: 'DELETE',
            url: 'deceased/'+id,
            dataType: 'JSON',
            data: $(this).serialize(),
            success: function (response) {
                if (!response.error) {
                    generateTable();
                    $('#deleteModal').modal('hide');
                } else {
                    console.log(e);
                }
            }, error: function (e) {
                console.log(e);
            }
        })
    });

    $('#deceasedForm').on('submit', function (e) {
        e.preventDefault();
        let data = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'deceased',
            data: data,
            success: function (response) {
                if (!response.error) {
                    generateTable();
                    $('#deceasedForm')[0].reset();
                } else {
                    alert('Something went wrong');
                }
            }, error: function (e) {
                alert('Something went wrong');
            }
        })
    });

    $('#updateFormBtn').on('click', function() {
        $('#updateFormDeceased').submit();
    });

    $('#updateFormDeceased').on('submit', function (e) {
        e.preventDefault();
        let action = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url : action,
            data: $(this).serialize(),
            success: function (response) {
                if (!response.error) {
                    generateTable();
                } else {
                    alert('Something went wrong');
                }
            }, error: function (e) {
                console.log(e);
            }
        });
    });

    $('#lightingForm').on('submit', function (e) {
        e.preventDefault();
        let action = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: action,
            data: $(this).serialize(),
            success: function (response) {
                if (!response.error) {
                    lightingRecord(response.data.deceased_id);
                    alert(response.message);
                    $('#lightingForm')[0].reset();
                } else {
                    console.log(response.message);
                }
            }, error: function (error) {
                console.log(error);
            }
        });
    });

    $('#formDeceasedApproval').on('submit', function (e) {
        e.preventDefault();
        let action = $(this).attr('action');

        $.ajax({
            type: 'PUT',
            url: action,
            data: $(this).serialize(),
            success: function (response) {
                if (!response.error) {
                    generateTable();
                } else {
                    console.log('Something went wrong');
                }
                $('#approveDeceasedModal').modal('hide');
            }, error: function (e) {
                console.log(e);
            }
        })
    });
});
