$(document).ready(function(){
    $('#reportTable').DataTable();
    $('#htmlReport').summernote({
        placeholder: 'Enter your template here',
        tabsize: 2,
        height: 400
    });
    $('.dropdown-toggle').dropdown()
});
