//este metodo es para la busqueda de productos en la pagina principal
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


document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
    // Se obtienen los valores del formulario
    var idProducto = this.querySelector('input[name="id_producto"]').value;
    var cantidad = this.querySelector('input[name="cantidad"]').value;

    // verfica el boton que fue seleccionado
    var botonPresionado = event.submitter.name;

    // Si se desea comprar ahora, se le redirigue a la página de compra
    if (botonPresionado === 'comprar_ahora') {
        return;
    }

    // Si se desea agregar al carrito, solo se agrega al carrito
    var url = 'Infoproducto.php?id_producto=' + idProducto;
    window.location.href = url;

    event.preventDefault();
});


