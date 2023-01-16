/* Este script es para cuando el usuario no tenga la sesión iniciada y se le muestre un mensaje en el iniciar sesión */
const titulo = document.getElementById("h1IniciarSesion");
const sesionExiste = localStorage.getItem("ss");
if (sesionExiste) {
  titulo.textContent = "Inicia sesión antes de finalizar tu compra ";
}

const formlogin = document.getElementById("form-login");

// Creando objeto
let datos = {
  id: null,
  contrasena: null,
};

formlogin.addEventListener("submit", function (e) {
  e.preventDefault();
  // Recogiendo datos ingresados por el usuario
  let id = document.getElementById("id").value;
  let contrasena = document.getElementById("contrasena").value;
  console.log(id + " " + contrasena);
  datos.id = id;
  datos.contrasena = contrasena;
  $.ajax({
    url: "../../Controllers/php/users/acceso.php",
    type: "post",
    data: {
      iniciarSesion: JSON.stringify(datos),
    },
    success: function (resp) {
      $("#respuesta").html(resp);
      if (resp == 1) {
        Swal.fire({
          type: "success",
          html: "<strong>¡BIENVENIDO (A) Comprador/Proveedor!</strong>",
        });
        document.location.href = "../dashboard/principal/dashboard.php";
      } else if (resp == 2) {
        Swal.fire({
          type: "success",
          html: "<strong>¡BIENVENIDO (A) Administrador!</strong>",
        });
        document.location.href = "../dashboard/principal/dashboardAdmin.php";
      } else if (resp == 3) {
        Swal.fire({
          type: "warning",
          html: "<strong>¡Hola! le informamos que su cuenta se encuentra en estado <strong>INACTIVO</strong> si crees que se trate de un error por favor comunícate con nosotros... <a href='soporte'>aquí</a><br><br>¡Muchas gracias!</strong>",
        });
      } else if (resp == 0) {
        Swal.fire({
          type: "error",
          html: "<strong>¡Hola! te informamos que el correo o documento y/o contraseña están errados</strong>",
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
});
