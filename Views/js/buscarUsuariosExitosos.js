const fechaInicial = document.getElementById("in-fecha-inicial");
const fechaFin = document.getElementById("in-fecha-final");
const btnBuscarUsuarios = document.getElementById("buscarUsuarios");
let contenedorFilasUsuarios = document.getElementById("filasUsuarios");
/* Crear objeto */
let fechas = {
  inicial: null,
  final: null,
};
//Evento para el botón
btnBuscarUsuarios.addEventListener("click", function () {
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
      data: { filtroFechasUsuarios: JSON.stringify(fechas) },
      success: function (res) {
        /* console.log(JSON.parse(res)); */
        renderUsuarios(JSON.parse(res));
      },
    });
  }
});
function renderUsuarios(usuarios) {
  let contFilasUsuarios = "";
  if (!usuarios.length) {
    contFilasUsuarios = `
    <!-- En caso de que no existan usuarios exitosos -->
    <tr>
      <td colspan="5">
          <div class="alert alert-danger" role="alert" style="text-align: center;">Opps, No hay usuarios exitosos para las fechas seleccionadas.</div>
      </td>
    </tr>`;
  }
  usuarios.forEach((index) => {
    contFilasUsuarios += `<tr>
      <td>
        ${index.documentoIdentidad}
      </td>
      <td>
        ${index.nombresUsuario}
      </td>
      <td>
        ${index.apellidoUsuario}
      </td>
      <td>
        ${index.Cantidad}
      </td>
      <td>
        $${number_format(Math.round(index.Total), 3, "", ".")}
      </td>
    </tr>`;
  });
  contenedorFilasUsuarios.innerHTML = contFilasUsuarios;
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
