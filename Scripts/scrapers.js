/* Se importa la librería puppeteer -- Headless browser */
const puppeteer = require('puppeteer');
//Link de la publicación a extraer la información
let url = 'https://articulo.mercadolibre.com.co/MCO-561640835-taladro-atornillador-14v-inalambrico-10mm-klatter-_JM#reco_item_pos=4&reco_backend=promotions-sorted-by-score-mco-B&reco_backend_type=low_level&reco_client=home_seller-promotions-recommendations&reco_id=48d73b94-424f-4534-b527-8c9b9352a7b1&c_id=/home/promotions-recommendations/element&c_element_order=5&c_uid=98598e73-aed3-407b-97a1-14db96912b28';

/* Se crea función para extraer la información */
async function scraprePublicacion(url) {
    //Se inicializa el navegador
    const browser = await puppeteer.launch();
    //Se inicializa una página en blanco
    const page = await browser.newPage();
    //Se indica la dirección, en este caso la url que reciba como argumento la fc()
    await page.goto(url);
    //En este caso particular utilizo $$ para llamar al elemento por su clase y no por su Xpath 
    const [el] = await page.$$('.ui-pdp-title');
    const txt1 = await el.getProperty('textContent'); //Se obtiene la propiedad que se desee del elemento
    const imgUrl = await txt1.jsonValue(); //En este caso, como no es un string sino una imagen, se debe usar json.value() para obtener el string (url en este caso)

    const [el2] = await page.$$('.price-tag-fraction');
    const txt = await el2.getProperty('textContent'); //Propiedad para obtener el texto 
    const title = await txt.jsonValue();

    const [el3] = await page.$$('.ui-pdp-description__content');
    const txt2 = await el3.getProperty('textContent'); 
    const price = await txt2.jsonValue();
    
    console.log(imgUrl, title, price);

    /* Cierra el navegador finalizando así el proceso */
    browser.close();

    /* Notas:
     1. Usar fullXpath en caso de que Xpath no funcione
     2. Como node corre del lado del servidor, se puede automatizar el proceso 
     Obtiendo el primer item y almacenándolo en 'el' "destructuring" - $x puppeteer selector para usarlo con Xpath*
     */
}
/* Llamando la función */
scraprePublicacion(url);

/* TODO:
    1. Definir la tabla donde se van a alamacenar los links
    2. Terminar la extensión
    3. Buscar la manera de automatizar las consultas desde el servidor
*/