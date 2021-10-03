const input = document.getElementById("busquedas");
const inputHandler = function(e){
    let busqueda = e.target.value;
    $.ajax({
        url: "../../Models/php/busquedas.php",
        type: "POST",
        data: {busqueda: busqueda},
        success: function(res){
            console.log(res); //Imprime en la consola los resultados de la búsqueda
        }
    });
}
//Detectar cambios de forma inmediata
input.addEventListener('input', inputHandler);
input.addEventListener('propertychange', inputHandler);