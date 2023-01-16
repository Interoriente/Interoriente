const formregistro = document.getElementById("form-registro");

// Creando objeto
let datos = {
  documento: null,
  nombre: null,
  apellido: null,
  correo: null,
  contrasena: null,
};

// Evento de submit
formregistro.addEventListener("submit", (e) => {
  e.preventDefault();

  // Recogiendo datos ingresados por el usuario
  let contrasena = document.getElementById("contrasena").value;
  let repcontrasena = document.getElementById("repcontrasena").value;
  if (contrasena !== repcontrasena) {
    Swal.fire({
      type: "warning",
      html: "<strong>¡Las contraseñas no coinciden!</strong>",
      confirmButtonText: "Volver",
    });
  } else {
    let documento = document.getElementById("documento").value;
    let nombres = document.getElementById("nombres").value;
    let apellidos = document.getElementById("apellidos").value;
    let correo = document.getElementById("correo").value;

    datos.documento = documento;
    datos.nombre = nombres;
    datos.apellido = apellidos;
    datos.correo = correo;
    datos.contrasena = contrasena;
    $.ajax({
      url: "../../Controllers/php/users/acceso.php",
      type: "post",
      data: {
        registro: JSON.stringify(datos),
      },
      success: function (resp) {
        $("#respuesta").html(resp);
        if (resp == 1) {
          Swal.fire({
            type: "success",
            html: "<strong>¡BIENVENIDO (A)!</strong>",
          });
          document.location.href = "../dashboard/principal/dashboard";
        } else if (resp == 2) {
          Swal.fire({
            type: "warning",
            html: "¡El correo y/o número de documento ingresado ya existe! Por favor verifícalos e intenta nuevamente!",
          });
        } else {
          Swal.fire({
            type: "error",
            html: resp,
          });
        }
      },
    });
    return false;
  }
});
