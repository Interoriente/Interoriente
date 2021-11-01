const titulo = document.getElementById("h1IniciarSesion");
const sesionExiste = localStorage.getItem("ss");
if (sesionExiste) {
    titulo.textContent = "Inicia sesión antes de finalizar tu compra ";
}



