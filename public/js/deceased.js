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
                        <td>`+element['location']+`</td>
                        <td>`+(element['remarks'] == null ? '' : element['remarks'])+`</td>`;
                    if (element['payment'] == null) {
                        html += `
                        <td></td>
                        `;
                    } else {
                        html += `
                            <td>`+element['payment']['ORNumber']+`</td>
                        `;
                    }

                    html +=`<td><button class="btn btn-success btn-edit" data-id="`+element['id']+`"><i class="fa fa-eye white" aria-hidden="true"></i></button>
                        <button class="btn btn-warning btn-ligthings" data-id="`+element['id']+`"><i class="fa fa-lightbulb-o white" aria-hidden="true"></i></button>
                        <button class="btn btn-danger btn-delete" data-id="`+element['id']+`" data-name="`+name+`"><i class="fa fa-trash white" aria-hidden="true"></i></button>
                        <button class="btn btn-primary btn-print" data-id="`+element['id']+`"><i class="fa fa-print white" aria-hidden="true"></i></button></td>
                    </tr>`;
                }
                $('#deceasedTable tbody').html(html);
                $('#deceasedTable').dataTable({
                    "aaSorting": []
                });

                viewRecord();
                deleteModal();
                lightingRecord();
                printingRecord();
            }, error: function (e) {
                console.log(e);
            }
        })
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
                    console.log(data);
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

                    $('#detailModal').modal('show');
                }, error: function (error) {
                    console.log(error);
                }
            });
        });
    }

    function lightingRecord()
    {
        $('.btn-ligthings').on('click', function () {
            let id = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: 'lighting/'+id,
                success: function (response) {
                    console.log(response);
                    $('#tableLightings').dataTable();
                    $('#lightingModal').modal('show');
                }, error: function (e) {
                    console.log(e);
                }
            });
        });
    }

    function printingRecord()
    {
        $('.btn-print').on('click', function () {
            let id = $(this).data('id');
            $('#printingModal').modal('show');
        });
    }


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
                    alert('Record is Deleted');
                    window.location.reload();
                } else {
                    alert('Something is wrong');
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
                console.log(response);
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
});
