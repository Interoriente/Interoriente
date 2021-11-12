/* Este script es para redireccionar al usuario una vez inicie sesión en caso de que tenga artículos en su carrito y quiera finalizar su compra */
const sesionExiste = localStorage.getItem("ss");
let carrito = JSON.parse(localStorage.getItem("carrito"));

if (sesionExiste && carrito.length > 0) {
  localStorage.removeItem("ss");
  /* Removiendo items para enviar solo los necesarios al la bd  */
  carrito = carrito.map(({ titulo, costo, ...rest }) => ({ ...rest }));
  carrito = JSON.stringify(carrito);
  $.ajax({
    url: "../../../Controllers/php/users/compras.php",
    type: "POST",
    dataType: "JSON",
    data: { carrito: carrito },
    success: function (respuesta) {
      if (respuesta === 1) {
        localStorage.removeItem("carrito");
        window.location = "../../navegacion/checkout.php";
      }
    },
  });
}
