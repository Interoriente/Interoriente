/* Declaración de constantes*/
const cartBtn = document.querySelector(".cart-items");
const closeCartBtn = document.querySelector(".close-cart");
const clearCartBtn = document.querySelector(".clear-cart");
const cartDOM = document.querySelector(".cart");
const cartOverlay = document.querySelector(".cart-overlay");
const cartItems = document.querySelector(".items-carrito");
const carritoTotal = document.querySelector(".cart-total");
const contenidoCarrito = document.querySelector(".cart-content");
const carritoTarjeta = document.querySelector(".carrito-tarjeta");
const carritoBtn = document.querySelector(".carrito-busqueda");
const cantidadCarrito = document.getElementById("cantidad-carrito");
const overlay = document.getElementById("overlay");
const finCompra = document.getElementById("finalizar-compra");


/* Local storage */
class Storage {
  static setPublicacion(publicacion) {
    localStorage.setItem("carrito", JSON.stringify(publicacion));
  }

  static getPublicacion() {
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
} else {
  console.log("No hay publicaciones en LocalStorage");
}
/* Seleccionar elemento padre para ejecutar una acción, en este caso, cerrar el carrito */
overlay.addEventListener("click", (e) => {
  if (e.target == e.currentTarget) {
    cerrarCarrito();
  }
});
/* Abriendo y cerrando carrito desde el botón */
carritoBtn.addEventListener("click", abrirCarrito);
closeCartBtn.addEventListener("click", cerrarCarrito);
/* Funciones para abrir y cerrar el carrito */

function cerrarCarrito() {
  /* Agregando clases al overlay y al carrito para abrirlo */
  cartOverlay.classList.remove("transparentBcg");
  cartDOM.classList.remove("showCart");
}

/* Función principal del carrito AJAX-JQUERY*/
function addCarrito(id) {
  /* Obteniendo id de la publicación para hacer consulta a la bd */
  $.ajax({
    /* LLamando clase PHP */
    url: "../../php/crud/consultas.php", //Ruta de la clase
    type: "POST", //Tipo de request,
    dataType: "JSON", //Tipo de dato a retornar
    data: { id: id }, //Datos a recibir en el script .php a traves de $_POST
    success: function (respuesta) {
      /* En caso de una respuesta exitosa */
      respuesta["cantidad"] = 1; //Agregando nuevo key and value al JSON
      carrito.push(respuesta); //Almacenando datos en el carrito
      Storage.setPublicacion(carrito); // Subiendo info a Localstorage
      /* console.log("Id de la publicación " + carrito[0].Id); */
      renderPubli(Storage.getPublicacion());
      mathCarrito(carrito);
      abrirCarrito();
    },
  });
}

/* Crear clase para mostrar elementos en el carrito */

function renderPubli(item) {
  let clase = "";
  item.map((item) => {
    clase += `
            <div class = "cart-item">
                <img src="../../assets/img/stock/1.jpg" alt="product" width="100%">
                <div>
                    <h4 class="titulos item-h" >${item.titulo}</h4>
                    <h5>$${item.costo}</h5>
                    <span class="remove-item" onclick = "removeItem(this.id)" id = "${item.id}">Eliminar</span>
                </div>
                <div>
                <input type="number" class="cantidad-items" id="${item.id}" oninput = "cambiarCantidad(this.id)" min = "1" value="${item.cantidad}" >
                </div>
            </div>
            `;
  });
  contenidoCarrito.innerHTML = clase;
}

let inputCantidad;
function abrirCarrito() {
  /* Agregando clases al overlay y al carrito para abrirlo */
  cartOverlay.classList.add("transparentBcg");
  cartDOM.classList.add("showCart");
  inputCantidad = document.querySelectorAll(".cantidad-items"); //Seleccionando todos los elementos con esa clase
}

/* Cambiar Cantidad */

function cambiarCantidad(idItem) {
  let id = idItem,
    inputId = 0;

  /* Identificando cuál es el input que está siendo usado */
  inputCantidad.forEach((element) => {
    if (element.id === id) {
      inputId = element;
    } else {
      console.log("No coinside");
    }
  });
  console.log("Resultado");
  console.log("Id: " + id);
  console.log("Cantidad: " + inputId.value);
  console.log(inputId);

  carrito = Storage.getPublicacion();

  /* Recorriendo el arreglo en busca del item con el mismo id */
  carrito.map((item) => {
    if (item.id === id) {
      item.cantidad = parseInt(inputId.value);
      console.log(carrito);
    }
  });

  Storage.setPublicacion(carrito);
  mathCarrito(Storage.getPublicacion());
}

/* Función para eliminar items */
function removeItem(id) {
  let publicaciones = Storage.getPublicacion();
  for (let i = 0; i < publicaciones.length; i++) {
    if (publicaciones[i].id === id) {
      publicaciones.splice([i], 1);
      break;
    }
  }
  Storage.setPublicacion(publicaciones);
  carrito = Storage.getPublicacion();
  renderPubli(carrito);
  mathCarrito(carrito);
}
/* Función para obtener valores del carrito */
function mathCarrito(item) {
  let totalTmp = 0,
    totalItems = 0,
    costo = 0;
  carrito.map((item) => {
    costo = parseFloat(item.costo);
    totalTmp += costo * item.cantidad;
    totalItems += item.cantidad;
  });
  carritoTotal.textContent = parseFloat(totalTmp.toFixed(2));
  cartItems.textContent = totalItems;
}

/* Finalizar Compra */
finCompra.addEventListener("click", function(){
  let carrito = Storage.getPublicacion();
  /* Removiendo items para enviar solo los necesarios al la bd  */
  carrito = carrito.map(({titulo,costo,...rest}) =>({...rest}));
  carrito = JSON.stringify(carrito);
  $.ajax({
    url: "../../php/crud/consultas.php",
    type: "POST",
    dataType: "JSON",
    data: {carrito: carrito},
    success: function (respuesta) {
      if (respuesta === 1) {
        window.location = "pago.php";
      }
    },
  });
});
