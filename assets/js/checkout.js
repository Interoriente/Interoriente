const cambiarCorreo = document.getElementById("cambiar-email");
const cambiarDireccion = document.getElementById("cambiar-direccion");
const contactoEmail = document.getElementById("contacto-email");
const contactoDireccion = document.getElementById("contacto-direccion");
let emailContactoP = document.getElementById("email-contacto-p");




let nuevoEmail;
let guardarEmail;

let infoCheckout

function cambiarCorreoContacto(){
    let correoUsuario = emailContactoP.textContent;
    const cambioEmail = `
       <div class="cambioEmail">
            <p>Se enviará información de esta compra al siguiente correo electrónico</p>
            <input id="nuevo-email" type="email" placeholder="Ej: pepe@gmail.com" value = "${correoUsuario}" >
            <div class="btn-guardar-cambios">
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

function cambiarDireccion() {


}

