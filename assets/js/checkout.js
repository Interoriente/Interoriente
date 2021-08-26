const cambiarCorreo = document.getElementById("cambiar-email");
const cambiarDireccion = document.getElementById("cambiar-direccion");
const contactoEmail = document.getElementById("contacto-email");
const contactoDireccion = document.getElementById("contacto-direccion");
const guardarDireccion = document.getElementById("guardar-direccion");
const guardarDireccionInput = document.getElementById("input-direccion");
const contDirPrincipal = document.getElementById(
  "contenedor-direccion-principal"
);
const contListaDirecciones = document.getElementById("contenedor-lista-dir");
const dire = document.querySelector(".direcciones");
let emailContactoP = document.getElementById("email-contacto-p");
let nuevoEmail;
let guardarEmail;
let infoCheckout;
let direcciones = [];
/* Verificar si direcciones existe en localstorage */
/* direcciones = localStorage.getItem("direcciones"); */

/* Validar direcciones */

$.ajax({
  /* LLamando clase PHP */
  url: "../../php/crud/consultas.php", //Ruta de la clase
  type: "GET", //Tipo de request,
  data: { idUsuarioLogeado: true }, //Datos a recibir en el script .php a traves de $_POST
  success: function (respuesta) {
    /* En caso de una respuesta exitosa */
    
    if (respuesta !== "[]") {
      /* En caso de que el usuario sí tenga una o más direcciones asociadas */
      /*  localStorage.setItem("direcciones", respuesta); */
      direcciones = JSON.parse(respuesta);
      renderDireccion(direcciones);
    } else {
      /* En caso de que el usuario NO tenga direcciones asociadas */
      $.ajax({
        url: "../../php/crud/consultas.php", //Ruta de la clase
        type: "GET", //Tipo de request,
        data: { ciudades: true }, //Datos a recibir en el script .php a traves de $_POST
        success: function (respuesta) {
          let ciudades = JSON.parse(respuesta);

          let ingresoDirDOM = `  <!-- Ingreso de dirección  -->
                <div class="addDireccion info-con ">
                  <p class="titulo-nueva-direccion">Por favor ingresa una dirección</p>
                  <label for="">Pon un nombre a la dirección (Opcional)</label>
                  <input type="text" id="input-nombre-direccion" placeholder="Ejemplo: mi casa, oficina, amigo pepe...">
                  <label for="">Ingresa la dirección (Nomenclatura)</label>
                  <input type="text" id="input-direccion" placeholder="Ejemplo: Calle 14 No. 45 AD 232">
                  <label for="">¿En qué ciudad se encuentra ubicada? </label> <br>
                  <div class = "select-ciudades">
                  <select name="ciudad" id="ciudad-nueva-direccion">
                
                  </select>
                  </div>
                  <div class="info-con save-dir"> 
                    <button id="guardar-direccion" onclick="guardarDir()">Guardar Dirección</button>
                  </div>
                </div>
                <!-- FIN Ingreso de dirección  -->`;
          contDirPrincipal.innerHTML = ingresoDirDOM;
          const selectCiudad = document.getElementById(
            "ciudad-nueva-direccion"
          );
          ciudades.map((item) => {
            let opciones = "";
            opciones = `<option value="${item.id}">${item.nombre}</option>;`;
            selectCiudad.innerHTML += opciones;
          });
        },
      });
    }
  },
});

/* Mostrar ciudades en lista desplegable */
function renderCiudades(ciudades) {
  ciudades.map((item) => {});
  console.log(selectCiudades);
}

function renderDireccion(direcciones) {
  let listaDireccionesDOM = "";
  direcciones.map((item) => {
  listaDireccionesDOM += `
                 <div class="elemento-lista-direcciones">
                    <div class="nombre-direccion">
                      <input type="radio" id="#" name="#" value="dewey">
                      <label for="dewey">${item.nombreDireccion} - ${item.direccion}</label>
                    </div>
                  </div>
               `;
  });
  contListaDirecciones.innerHTML = listaDireccionesDOM;
}

/* Datos direccion */

function cambiarCorreoContacto() {
  let correoUsuario = emailContactoP.textContent;
  const cambioEmail = `
       <div class="cambioEmail info-con">
            <p>Se enviará información de esta compra al siguiente correo electrónico</p>
            <input id="nuevo-email" type="email" placeholder="Ej: pepe@gmail.com" value = "${correoUsuario}" >
            <div class="btn-guardar-cambios info-con">
              <button id="btn-guardar-email" onclick = "guardarE()">guardar</button>
            </div>
          </div>
          `;
  guardarEmail = document.getElementById("btn-guardar-email");
  contactoEmail.innerHTML = cambioEmail;
}

/* Cambiar dirección en el caso de que exista */

function guardarE() {
  nuevoEmail = document.getElementById("nuevo-email").value;
  emailContactoP.textContent = nuevoEmail;
  const nuevoContactoEmail = ` <div id = "email-contacto" class="correo-contacto">
                <h6>Correo Electrónico</h6>
                <p id="email-contacto-p">${nuevoEmail}</p>
              </div>
              <div id="cambiar-email" class="btn-cambiar">
                  <p id="cambiar" onclick="cambiarCorreoContacto()">cambiar</p>
              </div>`;
  contactoEmail.innerHTML = nuevoContactoEmail;
}

function guardarDir() {
  let guardarNuevoNombre = document.getElementById("input-nombre-direccion");
  let guardarNuevaDir = document.getElementById("input-direccion");
}
