//Importando librerías
const puppeteer = require("puppeteer");
const mysql = require("mysql");
const { exit } = require("process");

//Creando Conexión con base de datos
const con = mysql.createConnection({
  host: "190.90.160.12",
  user: "interori_interori",
  password: "B4O#ugJ]C#%,4",
  database: "interori_interoriente",
  multipleStatements: true,
});

//Comprobando conexión y ejecutando consultas
con.connect(function (err) {
  //En caso de errores
  if (err) throw err;
  //Consulta
  const sql = "SELECT * FROM tblLinks WHERE estado = 0 LIMIT 1";
  //Ejecutando consulta
  con.query(sql, function (err, result) {
    if (err) throw err;
    //Capturando datos
    let link = result[0].url;
    id = result[0].id;
    categoria = result[0].categoria;
    //Llamando función encargada de extraer la información
    scraprePublicacion(link);
  });
});
//Función encargada de la extracción de información
async function scraprePublicacion(url) {
  //Se inicializa el navegador
  const browser = await puppeteer.launch({
    eadless: true,
    args: ['--use-gl=egl'],
  });
  //Se inicializa una página en blanco
  const page = await browser.newPage();
  //Se indica la dirección, en este caso la url que reciba como argumento la fc()
  await page.goto(url);
  //En este caso particular utilizo $$ para llamar al elemento por su clase y no por su Xpath
  const [el] = await page.$$(".ui-pdp-title");
  const txt1 = await el.getProperty("textContent"); //Se obtiene la propiedad que se desee del elemento
  const titulo = await txt1.jsonValue(); //En este caso, como no es un string sino una imagen, se debe usar json.value() para obtener el string (url en este caso)

  const [el2] = await page.$$(".price-tag-fraction");
  const txt = await el2.getProperty("textContent"); //Propiedad para obtener el texto
  let precio = await txt.jsonValue();

  const [el3] = await page.$$(".ui-pdp-description__content");
  const txt2 = await el3.getProperty("textContent");
  const descripcion = await txt2.jsonValue();

  //Obteniendo imágenes
  const imgs = await page.$$eval(
    ".ui-pdp-gallery__figure__image[src]",
    (imgs) => imgs.map((img) => img.getAttribute("src"))
  );

   precio = precio.replace(/\./g,'')
  let error = procesarInformacion(titulo, precio, descripcion, imgs);
  if (error) {
      exit();
  }
  //Terminado el proceso
  browser.close(); //Cierra el navegador
  /*  exit(); */ //Termina el script

  /* Notas:
     1. Usar fullXpath en caso de que Xpath no funcione
     2. Como node corre del lado del servidor, se puede automatizar el proceso 
     Obtiendo el primer item y almacenándolo en 'el' "destructuring" - $x puppeteer selector para usarlo con Xpath*
     */
}

function procesarInformacion(titulo, precio, descripcion, imgs) {
  const sqlUsuario =
    "SELECT documentoIdentidad AS id FROM tblUsuario ORDER BY RAND() LIMIT 1";
  con.query(sqlUsuario, function (err, result) {
    if (err) return err;
    let docId = result[0].id;
    let puntuacion = Math.floor(Math.random() * (5 - 1 + 1) + 1);
    let stock = Math.floor(Math.random() * (250 - 2 + 1) + 2);
    let cat = categoria;
    let val = 1;
    let pk = id;
    let values = [
      null,
      titulo,
      docId,
      descripcion,
      Number(precio),
      puntuacion,
      stock,
      Number(cat),
      val,
      Number(id),
    ];
    const sqlPublicacion = "INSERT INTO tblPublicacion VALUES (?)";
    con.query(sqlPublicacion, [values], function (err, result) {
      if (err) return err;
      imgs.forEach((img) => {
        let sqlImagenes = "INSERT INTO tblImagenes VALUES (?)";
        let imagen = [null, img, Number(result.insertId)];
        con.query(sqlImagenes, [imagen], function (err) {
          if (err) return err;
        });
      });
      const sqlLink = `UPDATE tblLinks SET estado = 1 WHERE id = ${pk}`;
      con.query(sqlLink, function (err) {
        if (err) return err;
        exit();
      });
    });
  });
}
