const cambiarCorreo = document.getElementById("cambiar-email");
const cambiarDireccion = document.getElementById("cambiar-direccion");
const contactoEmail = document.getElementById("contacto-email");
const contactoDireccion = document.getElementById("contacto-direccion");
const guardarDireccion = document.getElementById("guardar-direccion");
const guardarDireccionInput = document.getElementById("input-direccion");
let emailContactoP = document.getElementById("email-contacto-p");
let nuevoEmail;
let guardarEmail;
let infoCheckout
/* Check if tblDirecciones has matches */

  $.ajax({
    /* LLamando clase PHP */
    url: "../../php/crud/consultas.php", //Ruta de la clase
    type: "POST", //Tipo de request,
    data: {idUsuarioLogeado: true}, //Datos a recibir en el script .php a traves de $_POST
    success: function (respuesta) {
      /* En caso de una respuesta exitosa */
      console.log(respuesta); //Agregando nuevo key and value al JSON
      
    },
  });



function cambiarCorreoContacto(){
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
};

function guardarE(){
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
/* Cambiar dirección en el caso de que exista */

function guardarDir() {
 
}

