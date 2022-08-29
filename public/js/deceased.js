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
                        <td>`+element['dateDied']+`</td>
                        <td>`+(element['internmentDate'] == null ? '' : element['internmentDate'])+` `+(element['internmentTime'] == null ? '' : element['internmentTime'])+`</td>
                        <td>`+(element['expiryDate'] == null ? '' : element['expiryDate'])+`</td>
                        <td>`+element['location']+`</td>`;
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
                        <button class="btn btn-warning btn-ligthings"><i class="fa fa-lightbulb-o white" aria-hidden="true"></i></button>
                        <button class="btn btn-danger btn-delete" data-id="`+element['id']+`" data-name="`+name+`"><i class="fa fa-trash white" aria-hidden="true"></i></button>
                        <button class="btn btn-primary btn-print"><i class="fa fa-print white" aria-hidden="true"></i></button></td>
                    </tr>`;
                }
                $('#deceasedTable tbody').html(html);
                $('#deceasedTable').dataTable({
                    "aaSorting": []
                });
                deleteModal();
                viewRecord();
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
                    console.log(response);
                    $('#detailModal').modal('show');
                }, error: function (error) {
                    console.log(error);
                }
            });
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
});
