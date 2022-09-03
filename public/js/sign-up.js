$(document).ready(function(){
    $('#userTable').DataTable();

    $('.btn-update').on('click', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        $('#formActivateUser').attr('action', 'user/'+id);
        $('#activateUserModalBody').html('<p> Are you sure you want to update record of '+name+'?</p>');
        $('#activateUserModal').modal('show');
    });
});
