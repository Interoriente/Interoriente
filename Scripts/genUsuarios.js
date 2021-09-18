/* Tener en cuenta el llamado a la API--> Qué la dirección esté bien escrita. Revisar "Network"*/
let users = []; //Arreglo donde se van a almacenar los JSON con la información de cada usuario
/* Función Principal */
async function getUsuarios() {
  /* Para evitar error de accesso, usar proxy */
  const url =
    "https://aqueous-hamlet-16379.herokuapp.com/https://api.namefake.com/spanish-spain/random";

 //Se especifica el número de registros que se desean obtener
  const cantidadRegistros = 2;

  //Se itera hasta que se cumpla con el número de registros ingresados
  for (let i = 0; i < cantidadRegistros; i++) {
    /* No olvidar async y await para que la fn() termine antes de continuar con lo demás */
    let res = await fetch(url, {
      /* Especificar el formato esperado, en este caso JSON */
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
    })
      .then((res) => res.json())
      .then((data) => {
        users.push(data);
      });
  }

  /* Eliminando keys innesesarias */
  users = users.map(
    ({
      birth_data,
      blood,
      bonus,
      cardexpir,
      color,
      company,
      domain,
      domain_url,
      ipv4,
      email_d,
      email_url,
      eye,
      hair,
      height,
      ipv4_url,
      latitude,
      longitude,
      macaddress,
      maiden_name,
      phone_w,
      pict,
      plasticcard,
      sport,
      url,
      useragent,
      username,
      password,
      uuid,
      weight,
      ...rest
    }) => ({ ...rest })
  );

  /*Direcciones de correo electrónico que tendrán cada usuario */

  const dirEmail = [
    "gmail",
    "outlook",
    "hotmail",
    "protonmail",
    "zoho",
    "aol",
    "interoriente",
  ];

  /* Función para generar el documento de identidad */
  function getId() {
    let documetoIdentidad = "";
    for (let i = 0; i < 9; i++) {
      let randomValue = Math.floor(Math.random() * 10);
      randomValue = randomValue.toString();
      documetoIdentidad += randomValue;
    }
    return documetoIdentidad;
  }

  /* Agregando nuevas keys y values al JSON */
  for (let i in users) {
    /* Obteniendo dominio de Email aleatorio */
    let randomEmail = Math.floor(Math.random() * dirEmail.length);
    /* Obteniendo Documento de Identidad Generado */
    let docId = getId();
    /* Separando el nombre completo en Nombres y Apellidos */
    let nombreCompleto = users[i].name;
    let nombres = nombreCompleto.split(" ").slice(0, -1).join(" ");
    let apellidos = nombreCompleto.split(" ").slice(-1).join(" ");
    /* Creando dirección de Email del Usuario */
    let email = `${users[i].email_u}@${dirEmail[randomEmail]}.com`;
    /* Creando Keys y asigando Values */
    users[i].name = nombres;
    users[i].lastname = apellidos;
    users[i].id = docId;
    users[i].email_u = email;
  }

  /* Enviar arreglo a Script PHP */
  let usuarios = JSON.stringify(users);
  $.ajax({
    url: "../Models/php/InsercionUsuarios.php",
    method: "POST",
    data: { usuarios: usuarios },
    error: function(err){
      console.log(err);
    }
  });
  console.log(users);
}
/* Llamando a la función */
getUsuarios();

/* 
    El estado, la contraseña y la imagen desde php
*/
