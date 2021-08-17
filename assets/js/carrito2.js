/* Declaración de constantes*/
/* 
const cartBtn = document.querySelector(".cart-items");
const closeCartBtn = document.querySelector(".close-cart");
const clearCartBtn = document.querySelector(".clear-cart");
const cartDOM  = document.querySelector(".cart");
const cartOverlay  = document.querySelector(".cart-overlay");
const cartItems  = document.querySelector(".items-carrito");
const cartTotal  = document.querySelector(".cart-total");
const cartContent  = document.querySelector(".cart-content"); */
/* LLamando función getPublicaciones */
console.log("Test");
$.ajax({
    url: "../../php/consultas.php",
    success: function ($resultado){
        let resultado = $resultado;
        console.log(resultado);
    }
});

/* Carrito */
let carrito = [];
/* Local storage */
class Storage{
 
 
}
 