/* Declaración de constantes*/
const cartBtn = document.querySelector(".cart-items");
const closeCartBtn = document.querySelector(".close-cart");
const clearCartBtn = document.querySelector(".clear-cart");
const cartDOM  = document.querySelector(".cart");
const cartOverlay  = document.querySelector(".cart-overlay");
const cartItems  = document.querySelector(".items-carrito");
const carritoTotal  = document.querySelector(".cart-total");
const contenidoCarrito  = document.querySelector(".cart-content");
const carritoTarjeta  = document.querySelector(".carrito-tarjeta");
const carritoBtn = document.querySelector(".carrito-busqueda");
const cantidadCarrito = document.getElementById("cantidad-carrito");

    /* TODO: 

    FUNCIONAL:
                1. Eliminar publicaciones del carrito (ls)
                2. Actualizar valor del contador cuando se elimine la publicación
                3. Crear funcionalidad al input de cantidad (contador + actualizar Ls)
                4. Crear función para eliminar todos los elementos
                5. Redirigir a la publicación cuando se haga click
                6. Almacenar información cuando haya un evento en el btn "Finalizar Compra"
                7. Limpiar carrito cuando la compra haya finalizado

    */
/* Local storage */
class Storage{
 
    static setPublicacion(publicacion){
        localStorage.setItem("carrito", JSON.stringify(publicacion));
    }
 
    static getPublicacion(){
         return JSON.parse(localStorage.getItem("carrito"));
        
    }
}

/* Carrito */

let carrito = [];



/* Verificando existencia de llave en localStorage  */
let publicacionLocalStorage = Storage.getPublicacion();
if (publicacionLocalStorage) {
    carrito = publicacionLocalStorage;
    mathCarrito(carrito);
    renderPubli(carrito);
}else{
    console.log("No hay publicaciones en LocalStorage");
}
//Event listeners

    /* Abriendo y cerrando carrito desde el botón */
carritoBtn.addEventListener("click", abrirCarrito);
closeCartBtn.addEventListener("click", cerrarCarrito)

    /* Eliminando publicación del carrito */


/* Función principal del carrito AJAX-JQUERY*/
function addCarrito(id){
    /* Obteniendo id de la publicación para hacer consulta a la bd */
    $.ajax({
        /* LLamando clase PHP */
        url:"../../php/crud/consultas.php",    //Ruta de la clase
        type: "POST",    //Tipo de request,
        dataType: 'JSON', //Tipo de dato a retornar
        data: {id: id}, //Datos a recibir en el script .php a traves de $_POST
        success:function(respuesta){
            
            /* En caso de una respuesta exitosa */
            respuesta["cantidad"] = 1; //Agregando nuevo key and value al JSON 
            carrito.push(respuesta); //Almacenando datos en el carrito
            Storage.setPublicacion(carrito); // Subiendo info a Localstorage
           /* console.log("Id de la publicación " + carrito[0].Id); */
           renderPubli(Storage.getPublicacion());
           mathCarrito(carrito);
           abrirCarrito()
         
        }
    }); 
}
/* Función para obtener valores del carrito */
 function mathCarrito(item){
    let totalTmp = 0, totalItems = 0, costo = 0;
    carrito.map(item => {
        costo = parseFloat(item.Costo);
        totalTmp += costo * item.cantidad;
        totalItems += item.cantidad;   
    });
    carritoTotal.textContent = parseFloat(totalTmp.toFixed(2));
    cartItems.textContent = totalItems;  
}

/* Mostrar elementos en el carrito */
function renderPubli(item){
    let clase = "";
    item.map(item => {
            clase += 
            `
            <div class = "cart-item">
                <img src="../../assets/img/stock/1.jpg" alt="product" width="100%">
                <div>
                    <h4 class="titulos item-h" >${item.Título}</h4>
                    <h5>$${item.Costo}</h5>
                    <span class="remove-item" id = "${item.Id}">Eliminar</span>
                </div>
                <div>
                <input type="number" id="cantidad-carrito" min = "1" value = "${item.cantidad}">
                </div>
            </div>
            `
        })
        contenidoCarrito.innerHTML = clase;
}

/* Funciones para abrir y cerrar el carrito */
function abrirCarrito(){
    /* Agregando clases al overlay y al carrito para abrirlo */
    cartOverlay.classList.add('transparentBcg');
    cartDOM.classList.add('showCart');
   
}
function cerrarCarrito(){
    /* Agregando clases al overlay y al carrito para abrirlo */
    cartOverlay.classList.remove('transparentBcg');
    cartDOM.classList.remove('showCart');
   
}
/* Obteniendo elemento después de ser creado */


 