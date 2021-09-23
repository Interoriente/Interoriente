
const puppeteer = require('puppeteer');

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

    c/* onst [el4] = await page.$$('.ui-pdp-image');
    const img = await el4.getProperty('textContent'); 
    let imagenes = await img.jsonValue(); */
    
    console.log(price);

    /* Cierra el navegador finalizando así el proceso */
    browser.close();

    /* Notas:
     1. Usar fullXpath en caso de que Xpath no funcione
     2. Como node corre del lado del servidor, se puede automatizar el proceso 
     Obtiendo el primer item y almacenándolo en 'el' "destructuring" - $x puppeteer selector para usarlo con Xpath*
     */
}
scraprePublicacion(url);