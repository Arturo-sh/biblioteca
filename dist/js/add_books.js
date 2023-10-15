// $(document).change(function() {
//     alert("Hola");
// });

$(document).on('click', '.select2-results__option', function(){
    alert("Se");
});

$(document).on('click', '.btn-delete', function() {
    var id = $(this).attr("id");
    var url = $(this).attr("url");

    show_delete_alert(id, url);
});