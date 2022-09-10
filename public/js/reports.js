$(document).ready(function(){
    $('#reportTable').DataTable();
    $('.dropdown-toggle').dropdown()

    $('.btn-update').on('click', function () {
        let id = $(this).data('id');

        $.ajax({
            type: 'GET',
            url: 'reports/'+id,
            success: function (response) {
                $('.btn-cancel').addClass('active');
                $('#templateForm').attr('action', 'reports/'+response.data.id);
                $('#templateForm').append('<input type="hidden" name="_method" value="PUT">');
                $('#name').val(response.data.name);
                $('#htmlReport').val(response.data.htmlReport);
            }, error: function (e) {
                console.log(e);
            }
        })
    });
});
