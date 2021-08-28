const cambiarCorreo = document.getElementById("cambiar-email");
const cambiarDireccion = document.getElementById("cambiar-direccion");
const contactoEmail = document.getElementById("contacto-email");
const contactoDireccion = document.getElementById("contacto-direccion");
const guardarDireccion = document.getElementById("guardar-direccion");
const guardarDireccionInput = document.getElementById("input-direccion");
const contDirPrincipal = document.getElementById("contenedor-direccion-principal");
const direccion = document.getElementById("direccion");
const btnFinCompra = document.getElementById("btn-fin-compra");
const contListaDirecciones = document.getElementById("contenedor-lista-dir");
const direccionesContacto = document.querySelector(".direcciones");
let direccionFinalCont = document.getElementById("direccion-final-cont");
let contenedorDirFin = document.getElementById("contenedor-direccion-final");
let emailContactoP = document.getElementById("email-contacto-p");
let tituloDireccion = document.getElementById("direccion");
let nuevoEmail;
let direcciones = [];
/* Datos finales */
let correoElectronicoF = emailContactoP.innerText;
let direccionEnvioF = tituloDireccion.innerText;
/* Verificar si direcciones existe en localstorage */
let nuevaDir = localStorage.getItem("nueva-direccion");
if (nuevaDir) {
  direccionFinal();
}
/* Validar direcciones */

$.ajax({
  /* LLamando clase PHP */
  url: "../../php/crud/consultas.php", //Ruta de la clase
  type: "POST", //Tipo de request,
  data: { idUsuarioLogeado: true }, //Datos a recibir en el script .php a traves de $_POST
  success: function (respuesta) {
    /* En caso de una respuesta exitosa */
    
    if (respuesta !== "[]") {
      /* En caso de que el usuario sí tenga una o más direcciones asociadas */
     
      localStorage.setItem("direcciones-usuario", respuesta);
      direcciones = JSON.parse(respuesta);
      renderDireccion(direcciones);
    } else {
      /* En caso de que el usuario NO tenga direcciones asociadas */
      if (!nuevaDir) {
        direccionesContacto.style.display = "none";
        contDirPrincipal.innerHTML = `  <!-- Ingreso de dirección  -->
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

        const selectCiudad = document.getElementById("ciudad-nueva-direccion");

        $.ajax({
          url: "../../php/crud/consultas.php", //Ruta de la clase
          type: "POST", //Tipo de request,
          data: { ciudades: true }, //Datos a recibir en el script .php a traves de $_POST
          success: function (respuesta) {
            let ciudades = JSON.parse(respuesta);
            ciudades.map((item) => {
              let opciones = "";
              opciones = `<option value="${item.id}">${item.nombre}</option>;`;
              selectCiudad.innerHTML += opciones;
            });
          },
        });
      }
    }
  },
});


/* Funciones */

/* Mostrar ciudades en lista desplegable */
function renderCiudades(ciudades) {
  ciudades.map((item) => {});
  console.log(selectCiudades);
}


function renderDireccion(direcciones) {
  
  tituloDireccion = document.getElementById("direccion");
  tituloDireccion.textContent = direcciones[0].direccion;
  emailContactoP.textContent =  direcciones[0].correo
  direccionEnvioF = direcciones[0].direccion;
  correoElectronicoF = direcciones[0].correo;
  let listaDireccionesDOM = "";
  direcciones.map((item) => {
  listaDireccionesDOM += `
                 <div class="elemento-lista-direcciones">
                    <div class="nombre-direccion">
                      <input class = "radio-dir" type="radio" id="${item.id}" name="direccion" value="${item.nombreDireccion}">
                      <label for="${item.id}">${item.nombreDireccion} - ${item.direccion}</label>
                    </div>
                  </div>
               `;
  });
  /* Hasta aquí llega bien */

  contListaDirecciones.innerHTML = listaDireccionesDOM;
}



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
  contactoEmail.innerHTML = cambioEmail;
}

/* Cambiar dirección en el caso de que exista */

function guardarE() {
  nuevoEmail = document.getElementById("nuevo-email").value;
  correoElectronicoF = nuevoEmail;
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
  let nuevaDireccion = [];
  let nuevoNombre = document.getElementById("input-nombre-direccion").value;
  let nuevaDir = document.getElementById("input-direccion").value;
  let codMunicipio = document.getElementById("ciudad-nueva-direccion").value;
  let direccion = {
    nombreDireccion: nuevoNombre,
    direccion: nuevaDir
  };
  nuevaDireccion.push(direccion);
  localStorage.setItem("nueva-direccion", JSON.stringify(nuevaDireccion));
  direccionFinal()
  
}

function direccionFinal() {
  let direccionFinal = localStorage.getItem("nueva-direccion");
  direccionFinal = JSON.parse(direccionFinal);
  direccionFinal.map(item =>{
    contDirPrincipal.innerHTML = `  <div class="direcciones contacto">
              <div class="direccion correo-contacto cont-dir">
                <h6>Dirección de envío</h6>
                <div class="direccion-final">
                  <p id="direccion">${item.direccion}</p>
                  <p id="cambiar" class="editar-direccion" onclick="cambiarDireccionEnvio()">cambiar</p>
                </div>              
              </div>
            </div>`;
  });
}

function cambiarDireccionEnvio() {
  let direccionActual = tituloDireccion.textContent;
  const cambioDir = `
       <div class="cambioEmail info-con">
            <p>Puedes modificar la direccion a continuación:</p>
            <input id="nueva-dir" type="text" placeholder="Ej: Carrera 23 No. 34 23" value = "${direccionActual}" >
            <div class="btn-guardar-cambios info-con">
              <button id="btn-guardar-email" onclick = "guardarNuevaDireccion()">guardar</button>
            </div>
          </div>
          `; 
  contenedorDirFin.innerHTML = cambioDir;
}
function guardarNuevaDireccion() {

  nuevaDir = document.getElementById("nueva-dir").value;
  direccionEnvioF = nuevaDir;
  tituloDireccion.textContent = nuevaDir;
  const nuevaDireccion = ` 
  <div id="direccion-final-cont" class="direccion-final">
                <p id="direccion">${nuevaDir}</p>
                <p id="cambiar" class="editar-direccion" onclick = "cambiarDireccionEnvio()" >cambiar</p>
              </div>`;
  contenedorDirFin.innerHTML = nuevaDireccion;
}

btnFinCompra.addEventListener("click",function(){

  let checkout = {
    direccion: direccionFinal,
    email: correoElectronicoF
  }

  /* Ajax Call */


});