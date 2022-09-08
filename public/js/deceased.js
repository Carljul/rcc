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
                        <td>`+(element['internmentDate'] == null ? '' : element['internmentDate'])+` `+(element['internmentTime'] == null ? '' : element['internmentTime'])+`</td>

                        <td>`+(element['location'] == null ? '' : element['location'])+`</td>`;
                    if (element['payment'] == null) {
                        html += `
                        <td></td>
                        `;
                    } else {
                        html += `
                            <td>`+element['payment']['ORNumber']+`</td>
                        `;
                    }
                    html += `<td>`+(element['isApprove'] ? 'Approved' : 'For Approval')+`</td>`;
                    html +=`<td><button class="btn btn-success btn-edit" data-id="`+element['id']+`"><i class="fa fa-eye white" aria-hidden="true"></i></button>
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
                        null,
                        null,
                        { "width": "24%" }
                    ]
                });

                $('.btn-ligthings').on('click', function () {
                    let id = $(this).data('id');
                    lightingRecord(id);
                });
                viewRecord();
                deleteModal();
                printingRecord(response.reports);
                approveRecord();
            }, error: function (e) {
                console.log(e);
            }
        })
    }

    function approveRecord()
    {
        $('.btn-approve').on('click', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#approveDeceasedModalBody p').html('Are you sure you want to update approve status of '+name+'\'s record?');
            $('#formDeceasedApproval').attr('action', 'deceased/approval/'+id);
            $('#approveDeceasedModal').modal('show');
        });
    }

    function deleteModal()
    {
        $('.btn-delete').on('click', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#deleteModal #deleteModalBody p').html('Are you sure you want to delete the record of '+name+'?');
            $('#deleteModal #formDelete #deleteId').val(id);
            $('#deleteModal').modal('show');
        });
    }

    function viewRecord()
    {
        $('.btn-edit').on('click', function () {
            let id = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: 'deceased/'+id,
                success: function (response) {
                    let data = response.data;
                    $('#detailModalBody form')[0].reset();
                    $('#detailModalBody form').attr('action', 'deceased/'+data.id)
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
                    $('#viewRemarks').val(data.remarks);
                    if (data.payment != null) {
                        $('#viewamount').val(data.payment.amount);
                        $('#viewornumber').val(data.payment.ORNumber);
                        $('#viewdatepaid').val(data.payment.datePaid);
                    }

                    if (data.relative != null) {
                        $('#viewrelativeFirstname').val(data.relative.firstname);
                        $('#viewrelativeMiddlename').val(data.relative.middlename);
                        $('#viewrelativeLastname').val(data.relative.lastname);
                        $('#viewrelativeContactNumber').val(data.relative.contact_number);
                    }

                    if (data.approved_by != null) {
                        $('#isApprove').html('Record was approved by '+data.approved_by.name);
                    } else {
                        $('#isApprove').html('Record still needs approval');
                    }

                    $('#recordLogCreated').html('Record was created last <strong>'+dateTimeFormatter(data.created_at)+'</strong>');
                    $('#recordLogUpdated').html('Record was updated last <strong>'+dateTimeFormatter(data.updated_at)+'</strong>');

                    $('#detailModal').modal('show');
                }, error: function (error) {
                    console.log(error);
                }
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
                        html += `
                            <tr>
                                <td>`+element['id']+`</td>
                                <td>`+element['name']+`</td>
                                <td>`+element['dateOfConnection']+`</td>
                                <td>`+element['expiryDate']+`</td>
                                <td>Php `+numberWithCommas(element['amount'])+`</td>
                                <td>`+element['ORNumber']+`</td>
                                <td>`+status+`</td>
                                <td>
                                    <button class="btn btn-success btn-edit-lighting" data-id="`+element['id']+`" data-deceased-id="`+element['deceased_id']+`"><i class="fa fa-edit white" aria-hidden="true"></i></button>
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

    function printingRecord(reports)
    {
        $('.btn-print').on('click', function () {
            let html = '<p>Sorry no certificate available!</p>';
            if(reports.length > 0) {
                for (let i = 0; i < reports.length; i++) {
                    const element = reports[i];
                    html += `<div class="col card-contract" data-id="`+element.id+`" data-name="`+element.name+`">
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
            $('#printModalBody div.row#templates').html(html);
            $('#printingModal').modal('show');

            $('.card-contract').on('click', function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                $('.card-contract .card').removeClass('active');
                $($(this)[0].children[0]).addClass('active');
                

                $('.reportSelected').val(id);
                $('.reportSelectedText').html(name);
                $('#formReport').attr('action', '/reports/'+id);
            });

            $('#createPDF').on('click', function () {
                $('#formReport').submit();
            });
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


    $('#formDelete').on('submit', function (e) {
        e.preventDefault();
        let id = $('#formDelete input#deleteId').val();
        $.ajax({
            type: 'DELETE',
            url: 'deceased/'+id,
            dataType: 'JSON',
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
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
                    alert('Saved');
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
