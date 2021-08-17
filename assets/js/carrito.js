/* Declaración de constantes*/


const cartBtn = document.querySelector(".cart-items");
const closeCartBtn = document.querySelector(".close-cart");
const clearCartBtn = document.querySelector(".clear-cart");
const cartDOM  = document.querySelector(".cart");
const cartOverlay  = document.querySelector(".cart-overlay");
const cartItems  = document.querySelector(".items-carrito");
const cartTotal  = document.querySelector(".cart-total");
const cartContent  = document.querySelector(".cart-content");
const carritoTarjeta  = document.querySelector(".carrito-tarjeta");

/* Carrito */

let carrito = [];
let item;
/* Función para agregar al carrito */
function addCarrito(id){
    /* Obteniendo id de la publicación para hacer consulta a la bd */
    $.ajax({
        /* LLamando función PHP */
        url:"../../php/crud/consultas.php",    //the page containing php script
        type: "POST",    //request type,
        dataType: 'JSON',
        data: {id: id}, //Datos a recibir en el script .php
        success:function(respuesta){
            /* Consulta SQL exitosa */
            let datosPublicacion = JSON.stringify(respuesta);
            localStorage.setItem("carrito", datosPublicacion);
        }
    });
    item = JSON.parse(localStorage.getItem("carrito"));
    carrito.push(item);
    console.log(carrito);
}

/* Local storage */
/* class Storage{
 
 
} */
 