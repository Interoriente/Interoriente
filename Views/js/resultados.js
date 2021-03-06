/* Este script es para mostrar los resultados de una búsqueda realizada por un usuario */
const resultadosDOM = document.getElementById("resultados");
const relacionadosDOM = document.getElementById("relacionados");
const keywordLs = localStorage.getItem("keyword");
let criterioBusqueda = null;
/* TODO:
1. Verificar si el criterio de busqueda es similar a una palabra. Ej. Celular es similar a Celulares
2. Separar palabras compuestas y comprobar si alguna tiene coincidencias con alguna publicación
3. Cuando se de click en la publicación, que muestre su información
EN CASO DE QUE DE EL TIEMPO:
  1. Resolver situación con carateres especiales
  2. Resolver situacion cuando se envía un solo caracter
*/

if (keywordLs === "" || keywordLs == null) {
  /* No hay nada que mostrar */
  resultadosDOM.innerHTML =
    "<p>Prueba digitando algo en la barra de búsqueda! <span>Ejemplo: 'Mesa'</span></p>";
} else {

    criterioBusqueda = separarString(keywordLs);
    getPublicaciones(criterioBusqueda);
}
function separarString(s) {
    return s.split(/(\s+)/).filter((e) => e.trim().length > 2);
}

function getPublicaciones(keywords) {
  $.ajax({
    url: "../../Models/php/busquedas.php",
    type: "POST",
    data: { getResultados: keywords },
    success: function (res) {
      if (JSON.parse(res).length === 0) {
        resultadosDOM.innerHTML = `<p>No se encontraron resultados para <span>${keyword}</span>...</p>`;
      } else {
        renderPublicaciones(JSON.parse(res));
      }
    },
  });
}
function renderPublicaciones(publicaciones) {
  let seccionResultados = `
  <div class="ordenar">
  <p>Ordenar por:</p>
  <select name="orden" id="ordenar">
  <option value="mayorPrecio">Más Vendidos</option>
  <option value="mayorPrecio">Mayor Precio</option>
  <option value="menorPrecio">Menor Precio</option>
  </select>
  </div> 
  <h5 id="titulo-resultados">Resultados de busqueda para <span>${keyword}</span></h5>
      `;
  let seccionSimilares = `
      <hr>
      <h5 id="res-similares">Es posible que alguno de los siguientes resultados tenga relación con <span>${keyword}</span></h5>
      `;
  const sinResultados = `
      <h5 id="titulo-resultados">No se encontraron resultados para <span>${keyword}</span></h5>
      `;
  let flagResultados = false;
  let flagResSimilares = false;
  publicaciones.map((item) => {
    let val = valKeyword(criterioBusqueda[0], item.Titulo);
    if (val) {
      seccionResultados += ` 
                <a id="${item.id}">
                    <div class="resultado" id="${item.Id +'-'+item.Titulo}">
                        <img src="${item.Img}" alt="${item.Titulo}">
                        <div class="info-publicacion">
        
                            <p class="titulo">${item.Titulo}</p>
                            <p class="precio">$${item.Precio}</p>
        
                        </div>
                    </div>
                </a>
            `;
      if (!flagResultados) {
        flagResultados = true;
      }
    } else {
      seccionSimilares += ` 
              <a id="${item.id}">
                  <div class="resultado" id="${item.Id +'-' +item.Titulo}">
                      <img src="${item.Img}" alt="${item.Titulo}">
                      <div class="info-publicacion">
      
                          <p class="titulo">${item.Titulo}</p>
                          <p class="precio">$${item.Precio}</p>
      
                      </div>
                  </div>
              </a>
          `;
      if (!flagResSimilares) {
        flagResSimilares = true;
      }
    }
  });
  if (flagResultados) {
    resultadosDOM.innerHTML = seccionResultados;
  } else {
    resultadosDOM.innerHTML = sinResultados;
  }
  if (flagResSimilares) {
    relacionadosDOM.innerHTML = seccionSimilares;
  }
}
//Cuando el usuario de click en alguno de los resultados
$(document).on("click", ".resultado", function() {
  //this == Link al cuál se le da click
  let data = $(this).attr("id");
  let id = data.split('-', 1)[0];
  let titulo = data.split('-', 2)[1];
  $.ajax({
    url: "../../Models/php/busquedas.php",
    type: "POST",
    data: {publicacion: id},
    success: function(res){
     window.location.href =`publicacion.php?id=${res}&?nombre=${titulo}`;
    }
  });
});
//Verificar si la palabra a buscar existe en el titulo o no
function valKeyword(word, str) {
  const allowedSeparator = "\\s,;\"'|()/+-";

  const regex = new RegExp(
    `(^.*[${allowedSeparator}]${word}$)|(^${word}[${allowedSeparator}].*)|(^${word}$)|(^.*[${allowedSeparator}]${word}[${allowedSeparator}].*$)`,
    // Case insensitive
    "i"
  );

  return regex.test(str);
}

