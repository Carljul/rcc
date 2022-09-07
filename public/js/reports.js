$(document).ready(function(){
    $('#reportTable').DataTable();
    $('#htmlReport').summernote({
        placeholder: 'Enter your template here',
        tabsize: 2,
        height: 400
    });
    $('.dropdown-toggle').dropdown()

    $('.btn-update').on('click', function () {
        let id = $(this).data('id');

        $.ajax({
            type: 'GET',
            url: 'reports/'+id,
            success: function (response) {
                $('.btn-cancel').addClass('active');
                $('#templateForm').attr('action', 'report/'+response.data.id);
                $('#templateForm').append('<input type="hidden" name="_method" value="PUT">');
                $('#name').val(response.data.name);
                $('#htmlReport').summernote('code', response.data.htmlReport);
            }, error: function (e) {
                console.log(e);
            }
        })
    });
});
