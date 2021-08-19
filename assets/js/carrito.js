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
const carritoBtn = document.getElementById("btn-carrito");
/* Local storage */
class Storage{
 
    static setPublicacion(publicacion){
        localStorage.setItem("carrito", JSON.stringify(publicacion));
    }
 
    static getPublicacion(){
         return JSON.parse(localStorage.getItem("carrito"));
        
    }
}

/* TODO: Solucionar problema de sobreescritura cuando se renderizan 
    los elemenentos en el carrito.
*/
/* Carrito */
/* localStorage.clear(); */
let carrito = [];
let item;


/* Verificando existencia de llave en localStorage  */
let publicacionLocalStorage = Storage.getPublicacion();
if (publicacionLocalStorage) {
    carrito = publicacionLocalStorage;
    console.log(carrito)
    renderPublicacion(carrito);
}else{
    console.log("No hay publicaciones en LocalStorage");
    
}

/* Abriendo carrito desde el botón */
carritoBtn.addEventListener("click", abrirCarrito);
closeCartBtn.addEventListener("click", cerrarCarrito)
/* Función principal del carrito */
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
           mathCarrito(carrito);
           renderPublicacion(Storage.getPublicacion());
         
           abrirCarrito()
        }
    }); 
    /* Función para obtener valores del carrito */
     function mathCarrito(carrito){
        let totalTmp = 0, totalItems = 0, costo = 0;
        carrito.map(item => {
            costo = parseFloat(item.Costo);
            totalTmp += costo * item.cantidad;
            totalItems += item.cantidad;   
        });
        carritoTotal.textContent = parseFloat(totalTmp.toFixed(2));
        cartItems.textContent = totalItems;  
     }
}



function renderPublicacion(item) {
    const div = document.createElement('div'); //método del objeto "document" para crear elementos HTML
    div.classList.add("cart-item");
    let count = 0;
   /*  console.log("Tamaño del arreglo:" + item.length); */ //Revisión
    
   /* Renderizando elementos en el carrito */
        item.map(item => {
            div.innerHTML = `
            <img src="../../assets/img/stock/1.jpg" alt="product" width="100%">
            <div>
            <h4>${item.Título}</h4>
            <h5>$${item.Costo}</h5>
            <span class="remove-item" data-id = "${item.Id}">Eliminar</span>
            </div>
            <div>
            <i class="fas fa-chevron-up" data-id = "${item.Id}"></i>
            <p class="item-amount">${item.cantidad}</p>
            <i class="fas fa-chevron-down"data-id = "${item.Id}"></i>
            </div>
    `
    count++;
        })
       
            console.log(count);
      
     contenidoCarrito.appendChild(div)
     /* console.log(contenidoCarrito); */ //Mostrando por consola el elemento con sus valores
}
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
/* Mostrar elementos en el carrito */


 