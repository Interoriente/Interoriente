/* const comprar = document.getElementById("comprar"); */
/* const contPrincipal = document.getElementById("contenedor-principal");
 */

$('#comprar').click(function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "../navegacion/prueba.html",
        data: { },
        success: function(data){
            $('#contenedor-principal').html($(data).find('#content').html());
        }
    });
});
