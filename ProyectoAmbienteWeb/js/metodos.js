$(document).ready(function() {
    $('#busqueda').keyup(function() {
        var query = $(this).val();
        if (query != '') {
            $.ajax({
                url: "ScriptBusqueda.php",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#SugerenciasBusqueda').fadeIn().html(data);
                }
            });
        } else {
            $('#SugerenciasBusqueda').fadeOut();
        }
    });
});