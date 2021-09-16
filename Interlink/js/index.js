const inputEl = document.getElementById("input-el");
const inputBtn = document.getElementById("input-btn");
const ulEl = document.getElementById("ul-el");
const enviarDatos = document.getElementById("enviar-btn");
const leadsFromLocalStorage = JSON.parse(localStorage.getItem("myLeads"));
const tabBtn = document.getElementById("tab-btn");
const select = document.getElementById("categorias");
const error = document.getElementById("error");
$("#loader").hide();
let categoriasLs = localStorage.getItem("categorias");
let flag = false;
let categorias;
let myLeads = [];
enviarDatos.disabled = true;
if (!categoriasLs) {
  $.ajax({
    url: "https://aqueous-hamlet-16379.herokuapp.com/https://interoriente.com.co/Models/php/Data.php",
    data: { categorias: true },
    method: "GET",
    success: function (respuesta) {
      localStorage.setItem("categorias", respuesta);
      categorias = JSON.parse(respuesta);
      renderCategorias(categorias);
    },
  });
} else {
  categorias = JSON.parse(categoriasLs);
  renderCategorias(categorias);
}
if (leadsFromLocalStorage) {
  myLeads = leadsFromLocalStorage;
  render(myLeads);
}
function renderCategorias(arr) {
  arr.forEach((cat) => {
    select.innerHTML += `<option value="${cat.id}">${cat.nombre}</option>`;
  });
}
tabBtn.addEventListener("click", function () {
  chrome.tabs.query({ active: true, currentWindow: true }, function (tabs) {
    let link = tabs[0].url;
    let tabUrl = link.slice(8, 37);
    /* Validación de url */
    if (tabUrl.includes("mercadolibre")) {
      myLeads = JSON.parse(localStorage.getItem("myLeads"));
      if (myLeads) {
        for (let i = 0; i < myLeads.length; i++) {
          /* Validación de existencia de link */
          if (myLeads[i] === link) {
            flag = true;
            alert("Parece que ya agregaste este link...");
            break;
          }
        }
      }

      if (!flag) {
        myLeads.push(link);
        /* Hay in problema a la hora de querer agregar algo después de enviar la info a la bd 
                TODO:
                1. Identificar y resolver bugs de no renderizado de los links cuando se le da click a enviar lista
                LISTO
                2. Crear Script PHP para el envío de la información a través de AJAX

                3. Mostrar Mensaje de respuesta con algo visual
                1/2
                */

        localStorage.setItem("myLeads", JSON.stringify(myLeads));
        render(myLeads);
        flag = false;
      }
    } else {
      alert("Recuerda: Solo links de mercadolibre.com.co");
    }
  });
});
function render(leads) {
  let listItems = "";
  for (let i = 0; i < leads.length; i++) {
    listItems += `
            <li>
            <a target='_blank' href='${leads[i]}'>
             ${leads[i].slice(0, 100)}
            </a>
            <p style = "cursor:pointer;" id = "${
              leads[i]
            }" class = "removeElement">Eliminar</p>
            </li>
        `;
  }
  ulEl.innerHTML = listItems;
}

inputBtn.addEventListener("click", function () {
  if (inputEl.value !== "") {
    //Por qué estaba almacenando el valor anterior del localstorage??
    let link = inputEl.value;
    let url = link.slice(8, 37);

    /* Verificando que la url ingresada en el imput sea válida */
    if (url.includes("mercadolibre")) {
      /* Verificando exitencia de links en Localstorage */
      let leads = JSON.parse(localStorage.getItem("myLeads"));
      if (leads) {
        myLeads = leads;
        for (let i = 0; i < myLeads.length; i++) {
          if (myLeads[i] === link) {
            flag = true;
            alert("Este link ya se encuentra en la lista...");
            inputEl.value = "";
            break;
          }
        }
      }
      /* Guardando datos en caso de que pase las validaciones */
      if (!flag) {
        myLeads.push(inputEl.value);
        localStorage.setItem("myLeads", JSON.stringify(myLeads));
        render(myLeads);
        inputEl.value = "";
      }
    } else {
      inputEl.value = "";
      alert("Recuerda: Solo links de articulo.mercadolibre.com.co");
    }
  } else {
    alert("¿Por qué no agregar algo antes de intentar guardar?");
  }
});

/* USAR UN EVENT LISTENER ASÍ NO EXISTA EL ELEMENTO!!!!! */
document.addEventListener("click", removeElement);

function removeElement(event) {
  let myLeads = JSON.parse(localStorage.getItem("myLeads"));
  let elemento = event.target;
  let id = elemento.id;

  if (myLeads) {
    if (myLeads.length > 0) {
      for (let i = 0; i < myLeads.length; i++) {
        if (myLeads[i] === id) {
          myLeads.splice(i, 1);
          break;
        }
      }
    }
  }
  localStorage.setItem("myLeads", JSON.stringify(myLeads));

  render(myLeads);
}
document.addEventListener(
  "input",
  function (event) {
    // Only run for #wizard select
    if (event.target.id !== "categorias") return;

    if (event.target.value != "") {
      enviarDatos.disabled = false;
      enviarDatos.style.transition = ".01s";
      enviarDatos.style.backgroundColor = "#fcaf16";
      enviarDatos.style.cursor = "pointer";
    }
  },
  false
);

enviarDatos.addEventListener("dblclick", function () {

  let urls = JSON.parse(localStorage.getItem("myLeads"));
  if (urls != "") {
    let categoriaSeleccionada = select.value;
    urls.unshift(categoriaSeleccionada);
    $.ajax({
      url: "https://aqueous-hamlet-16379.herokuapp.com/https://interoriente.com.co/Models/php/Data.php",
      method: "POST",
      data: { links: urls },
      beforeSend: function () {
        
        $(select).hide();
        $(ulEl).hide();
        $("#loader").show();
      },
      complete: function () {
        $("#loader").hide();
        $(select).show();
        $(ulEl).show();
      },
      success: function (respuesta) {
        myLeads = [];
        localStorage.setItem("myLeads", JSON.stringify(myLeads));
        ulEl.innerHTML = "<p id='dataSuccess'>¡Datos Almacenados!</p>"
        ulEl.innerHTML += "<img id='img-success' src='../img/ilus.svg' alt=''>";
      },
      error: function (err) {
        
       error.innerHTML = `<p>Error: Es posible que uno o más elementos ya se encuentren almacenado en la base de datos. Por favor, verifíca e intenta nuevamente.</p>`;
      }
    });
  } else {
    alert("No hay nada que enviar!");
  }
});
