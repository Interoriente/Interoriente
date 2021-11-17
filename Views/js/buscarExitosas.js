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
    $${number_format(publicaciones.VlrVentas[i], 3, "", ".")}
    </td>
    <td>
    ≈ ${publicaciones.Porcentajes[i].toFixed(2)}%
    </td>
  </tr>`;
  }
  contenedorFilasExitosas.innerHTML = contFilasPublicaciones;
}

function number_format(number, decimals, dec_point, thousands_sep) {
  // Strip all characters but numerical ones.
  number = (number + "").replace(/[^0-9+\-Ee.]/g, "");
  let n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = typeof thousands_sep === "undefined" ? "." : thousands_sep,
    dec = typeof dec_point === "undefined" ? "." : dec_point,
    s = "",
    toFixedFix = function (n, prec) {
      let k = Math.pow(10, prec);
      return "" + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || "").length < prec) {
    s[1] = s[1] || "";
    s[1] += new Array(prec - s[1].length + 1).join("");
  }
  return s.join(dec);
}
