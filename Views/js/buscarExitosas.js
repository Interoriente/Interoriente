const fechaInicial = document.getElementById("in-fecha-inicial");
const fechaFin = document.getElementById("in-fecha-final");
const btnBuscarPublicacion = document.getElementById("buscarPublicacion");
let contenedorFilasExitosas = document.getElementById("filasExitosas");
let fechas = {
  inicial: null,
  final: null,
};
btnBuscarPublicacion.addEventListener("click", function () {
  if (fechaInicial.value == "" || fechaFin.value == "") {
    if (fechaInicial.value == "" && fechaFin.value == "") {
      alert("Por favor selecciona una fecha");
    } else if (fechaInicial.value == "") {
      alert("Por favor selecciona una fecha Inicial");
    } else {
      alert("Por favor selecciona una fecha final.");
    }
  } else {
    fechas.inicial = fechaInicial.value;
    fechas.final = fechaFin.value;
    $.ajax({
      url: "../../../Controllers/php/users/informes.php",
      type: "POST",
      data: { filtroFechasExitosas: JSON.stringify(fechas) },
      success: function (res) {
        renderPublicaciones(JSON.parse(res));
      },
    });
  }
});
function renderPublicaciones(publicaciones) {
  let contFilasPublicaciones = "";
  for (let i = 0; i < 5; i++) {
    if (publicaciones.VlrVentas[i] == undefined) {
      break;
    }
    contFilasPublicaciones += `<tr>
    <td>
      <a href="#"> ${publicaciones.Titulos[i]}</a>
    </td>
    <td>
      ${publicaciones.NoVentas[i]}
    </td>
    <td>
    ${publicaciones.Cantidad[i]}
    </td>
    <td>
    $${publicaciones.VlrVentas[i]}
    </td>
    <td>
    ${publicaciones.Porcentajes[i]}
    </td>
  </tr>`;
  }
  contenedorFilasExitosas.innerHTML = contFilasPublicaciones;
}
