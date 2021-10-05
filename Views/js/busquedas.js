/* Resolver situación con la encriptación del id de la publicación en la etiqueta <a> */
const input = document.getElementById("busquedas");
const resBusquedas = document.getElementById("res-busquedas");
const ulResultado = document.getElementById("resultado");
let keyword = localStorage.getItem("keyword");
let busqueda = null;

if (keyword) {
  input.value = keyword;
}
$(resBusquedas).hide();
const inputHandler = function (e) {
   busqueda = e.target.value;
  if (!busqueda) {
    ulResultado.innerHTML = "";
    localStorage.setItem("keyword", ""); 

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
  })
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