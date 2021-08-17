/* Declaración de constantes*/
const cartBtn = document.querySelector(".cart-items");
const closeCartBtn = document.querySelector(".close-cart");
const clearCartBtn = document.querySelector(".clear-cart");
const cartDOM  = document.querySelector(".cart");
const cartOverlay  = document.querySelector(".cart-overlay");
const cartItems  = document.querySelector(".items-carrito");
const cartTotal  = document.querySelector(".cart-total");
const contenidoCarrito  = document.querySelector(".cart-content");
const productsDom  = document.querySelector(".publicaciones");

/* Carrito */

let carrito = [];

/* Getting productos */
class Productos{
    async getProducts(){
        try{
            let result = await fetch("../../assets/json/productos.json"); /* Ajax request */
            let data = await result.json();
            let products = data.items;
            products = products.map(item =>{
                const {title,price} = item.fields;
                const {id} = item.sys;
                const image = item.fields.image.fields.file.url;
                return {title,price,id,image}; 
            })
            return products;
        }catch(error){
            console.log(error);
        }
    }
}

/* Display mostrar productos */

class UI {
    displayProducts(products){
        let result = "";
        products.forEach(product => {
            result += `
             <!-- Tarjeta Final -->
        <div class="tarjeta">
            <a href="publicacion.php">
                <div class="img-tarjeta">
                    <img id="img-p" src=${product.image} alt="Imagen tarjeta publicación">
                </div>
                <div class="contenido-tarjeta">
                    <h5> $${product.price}</h5>
                    <h3>${product.title} </h3>
                    <p>Resitente computadora excelente sesdfa excelente excelente... <span>más</span></p>
                </div>
            </a>

            <div class="cta-btns" data-id=${product.id}>
                <img src="../../assets/img/iconos/compras.svg" alt="Bolsa de la compra">
                <img src="../../assets/img/iconos/carrito_2.svg" alt="Bolsa de la compra">
            </div>
        </div>
        <!-- -- Fin tarjeta final--  -->
            `
        });
        productsDom.innerHTML = result;
    }
}

/* Local storage */
class Storage{}

document.addEventListener("DOMContentLoaded", () => {
    const ui = new UI();
    const products = new Productos();
    /* Get all products */ 
    products.getProducts().then(products => ui.displayProducts(products));
}) 