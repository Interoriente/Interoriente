/* Este script es para cuando el usuario no tenga la sesión iniciada y se le muestre un mensaje en el iniciar sesión */
const titulo = document.getElementById("h1IniciarSesion");
const sesionExiste = localStorage.getItem("ss");
if (sesionExiste) {
    titulo.textContent = "Inicia sesión antes de finalizar tu compra ";
}



