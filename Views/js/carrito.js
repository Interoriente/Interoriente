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
const carritoBtn = document.getElementById("carrito-btn");
const cantidadCarrito = document.getElementById("cantidad-carrito");
const overlay = document.getElementById("overlay");
const finCompra = document.getElementById("finalizar-compra");
let inputCantidad,
  publicacionExiste = false,
  inputExistente,
  newVlr,
  cantidadPublicacion,
  itemCarrito,
  existeCompra,
  itemCarritoBolean = false,
  resptblCarrito;

//Eliminando "Sesión no existe" de localStorage

if (localStorage.getItem("ss")) {
  localStorage.removeItem("ss");
}

//Verificando si el usuario tiene compras por realizar
$.ajax({
  url: "../../Controllers/php/users/compras.php",
  method: "GET",
  data: { tblCarrito: true },
  success: function (res) {
    resptblCarrito = JSON.parse(res);
    if (resptblCarrito !== 0) {
      existeCompra = `
     <div class="tarjeta-contenedor">
       <div class="contenedor-tarjeta">
           <p>!Tienes una compra pendiente!</p>
           <a href="./checkout.php" id="continuar-compra" class="continuar-compra">Ir al checkout</a>
       </div>
      </div>
     `;
      contenidoCarrito.innerHTML += existeCompra;
    }
  },
});
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
}

/* Seleccionar elemento padre para ejecutar una acción, en este caso, cerrar el carrito */
overlay.addEventListener("click", (e) => {
  if (e.target == e.currentTarget) {
    cerrarCarrito();
  }
});

$(document).keyup(function (e) {
  if (e.key === "Escape") {
    // escape key maps to keycode `27`
    //Optimizar esta parte en caso de que sea posible usando localstorage para detectar el estado del carrito
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
  publicacionLocalStorage = Storage.getPublicacion();
  /* Obteniendo id de la publicación para hacer consulta a la bd */
  if (publicacionLocalStorage) {
    for (let i = 0; i < publicacionLocalStorage.length; i++) {
      if (publicacionLocalStorage[i].id === id) {
        inputCantidad = document.querySelectorAll(".cantidad-items"); //Seleccionando todos los elementos con esa clase

        for (let i = 0; i < inputCantidad.length; i++) {
          if (inputCantidad[i].id === id) {
            inputExistente = inputCantidad[i];
            break;
          }
        }

        newVlr = parseInt(inputExistente.value) + 1;
        inputExistente.value = newVlr;
        cambiarCantidad(id);
        abrirCarrito();
        publicacionExiste = true;
        break;
      }
    }
    if (publicacionExiste != true) {
      getPublicacionDb(id);
    }
    publicacionExiste = false;
  } else {
    getPublicacionDb(id);
  }
}

function getPublicacionDb(id) {
  $.ajax({
    /* LLamando clase PHP */
    url: "../../Controllers/php/users/compras.php", //Ruta de la clase
    type: "POST", //Tipo de request,
    dataType: "JSON", //Tipo de dato a retornar
    data: { id: id }, //Datos a recibir en el script .php a traves de $_POST
    success: function (respuesta) {
      /* En caso de una respuesta exitosa */
      respuesta["cantidad"] = 1; //Agregando nuevo key and value al JSON
      carrito.push(respuesta); //Almacenando datos en el carrito
      Storage.setPublicacion(carrito); // Subiendo info a Localstorage
      renderPubli(carrito);
      mathCarrito(carrito);
      abrirCarrito();
    },
  });
}

/* Crear clase para mostrar elementos en el carrito */

function renderPubli(item) {
  itemCarrito = ``;
  if (existeCompra) {
    itemCarrito += existeCompra;
  }
  item.map((item) => {
    itemCarrito += `
            <div class = "cart-item">
                <img src="${item.img}" alt="product" width="100%">
                <div>
                    <h4 class="titulos item-h" >${item.titulo}</h4>
                    <h5>$${number_format(item.costo)}</h5>
                    <span class="remove-item" onclick = "removeItem(this.id)" id = "${
                      item.id
                    }">Eliminar</span>
                </div>
                <div>
                <input type="number" class="cantidad-items" id="${
                  item.id
                }" oninput = "cambiarCantidad(this.id)" min = "1" value="${
      item.cantidad
    }" >
                </div>
            </div>
            `;
  });
  contenidoCarrito.innerHTML = itemCarrito;
}

function abrirCarrito() {
  /* Agregando clases al overlay y al carrito para abrirlo */
  $("#res-busquedas").hide();
  cartOverlay.classList.add("transparentBcg");
  cartDOM.classList.add("showCart");
  inputCantidad = document.querySelectorAll(".cantidad-items"); //Seleccionando todos los elementos con esa clase
}


/* Cambiar Cantidad */

function cambiarCantidad(idItem) {
  let id = idItem,
    inputId = "";

  /* Identificando cuál es el input que está siendo usado */
  inputCantidad.forEach((element) => {
    if (element.id === id) {
      inputId = element;
    }
  });

  cantidadPublicacion = inputId.value;
  if (cantidadPublicacion === "" || /^0+$/.test(cantidadPublicacion)) {
    if (cantidadPublicacion === "") {
      cantidadPublicacion = "1";
    } else {
      cantidadPublicacion = "1";
      inputId.value = "1";
    }
  }
  carrito = Storage.getPublicacion();

  /* Recorriendo el arreglo en busca del item con el mismo id */
  carrito.map((item) => {
    if (item.id === id) {
      item.cantidad = parseInt(cantidadPublicacion);
    }
  });
  Storage.setPublicacion(carrito);
  mathCarrito(carrito);

  //Controlar input cuando esté vacíos 
  
  inputId.onblur = function() {
    if (inputId.value === "") {
      inputId.value = "1";
    }
  }
}

/* Función para eliminar items */
function removeItem(id) {
  carrito = Storage.getPublicacion();
  for (let i = 0; i < carrito.length; i++) {
    if (carrito[i].id === id) {
      carrito.splice([i], 1);
      break;
    }
  }
  Storage.setPublicacion(carrito);
  renderPubli(carrito);
  mathCarrito(carrito);
  inputCantidad = document.querySelectorAll(".cantidad-items");
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
  carritoTotal.textContent = number_format(parseFloat(totalTmp), 3, "", ".");
  cartItems.textContent = totalItems;
}

function number_format(number, decimals, dec_point, thousands_sep) {
  // Strip all characters but numerical ones.
  number = (number + "").replace(/[^0-9+\-Ee.]/g, "");
  let n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = typeof thousands_sep === "undefined" ? "." : thousands_sep,
    dec = typeof dec_point === "undefined" ? "." : dec_point,
    s = "",
    toFixedFix = function (n, prec) {
      let k = Math.pow(10, prec);
      return "" + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || "").length < prec) {
    s[1] = s[1] || "";
    s[1] += new Array(prec - s[1].length + 1).join("");
  }
  return s.join(dec);
}
/* Finalizar Compra */
finCompra.addEventListener("click", function () {
  let carrito = Storage.getPublicacion();
  /* Removiendo items para enviar solo los necesarios al la bd  */
  carrito = carrito.map(({ titulo, costo, ...rest }) => ({ ...rest }));
  carrito = JSON.stringify(carrito);
  $.ajax({
    url: "../../Controllers/php/users/compras.php",
    type: "POST",
    dataType: "JSON",
    data: { carrito: carrito },
    success: function (respuesta) {
      if (respuesta === 1) {
        localStorage.removeItem("carrito");
        window.location = "checkout.php";
      } else {
        localStorage.setItem("ss", "true");
        window.location = "./iniciarsesion.php";
      }
    },
  });
});
