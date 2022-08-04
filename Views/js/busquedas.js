/* Captura de elementos */
const input = document.getElementById("busquedas");
const resBusquedas = document.getElementById("res-busquedas");
const ulResultado = document.getElementById("resultado");
const buscar = document.getElementById("buscar");
let keyword = localStorage.getItem("keyword");
let busqueda = null;
if (keyword) {
  input.value = keyword;
}

$(resBusquedas).hide(); //Ocultar las búsquedas en caso de que existan al momento de refrescar la página

//Realizar una búsqueda
const inputHandler = function (e) {
   busqueda = e.target.value;
  if (!busqueda || busqueda === " ") {
    ulResultado.innerHTML = "";
    localStorage.removeItem('keyword');
  }else{
   localStorage.setItem("keyword", busqueda); 
    $.ajax({
    url: "../../Models/php/busquedas.php",
    type: "POST",
    data: { busqueda: busqueda },
    success: function (res) {
      renderResultados(JSON.parse(res));
    },
  });
}
};
//Detectar cambios de forma inmediata
input.addEventListener("input", inputHandler);
input.addEventListener("propertychange", inputHandler);
//Mostrar y No mostrar Ul con base en el estado del input (Activo o Inactivo)
$(input)
  .focusin(function () {
    $(resBusquedas).show();
    //Detectar Enter
    $(input).on('keypress', function (e) {
      if (e.key === 'Enter' || e.keyCode === 13) {
        window.location.href ="resultados.php";
      }
    }); 
    
  })
  /* Ocultar resultados cuando se de click fuera de la lista  */
  .focusout(function () {
      //En caso de que se de click dentro de la lista no se cierre
      resBusquedas.addEventListener("click", (e) => {
        if (e.target !== e.currentTarget) { 
            $(resBusquedas).hide();
        }
      });
    if (!busqueda) {
        ulResultado.innerHTML = "";
    }
  });
  //Función para mostrar los resultados de la consulta
function renderResultados(arr) {
  let resultados = "";
  arr.map((item) => {
    resultados += `
    <a class="url" id="${item.Id +'-' +item.Titulo}"href="#">
    <li id="tituloP">${item.Titulo}</li>
    </a>
    `;
  });
  ulResultado.innerHTML = resultados;
}
/* Evento para redireccionar al usuario cuando le de click a algún resultado de búequeda */
$(document).on("click", ".url", function() {
    //this == Link al cuál se le da click
    let data = $(this).attr("id");
    let id = data.split('-', 1)[0];
    let titulo = data.split('-', 2)[1];
    input.value = titulo;
    localStorage.setItem("keyword", titulo); 
    $.ajax({
      url: "../../Models/php/busquedas.php",
      type: "POST",
      data: {publicacion: id},
      success: function(res){
       window.location.href =`publicacion.php?id=${res}&?nombre=${titulo}`;
      }
    });
});

//Enviar palabra clave para mostrar resultados
 buscar.addEventListener("click", function(){
  window.location.href ="resultados.php";
}); 