
//Cuando se presenten problemas con el kernel: sudo sysctl -w kernel.unprivileged_userns_clone=1

const puppeteer = require('puppeteer');
const url = "https://articulo.mercadolibre.com.co/MCO-561640835-taladro-atornillador-14v-inalambrico-10mm-klatter-_JM#reco_item_pos=0&reco_backend=machinalis-homes&reco_backend_type=function&reco_client=home_navigation-recommendations&reco_id=71c59a74-07bc-439e-8b8d-d31c5b61e7bd&c_id=/home/navigation-recommendations/element&c_element_order=1&c_uid=8d9cb4a0-5e07-4f6d-9426-b2ab3a32eeec"

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
    const titulo = await txt1.jsonValue(); //En este caso, como no es un string sino una imagen, se debe usar json.value() para obtener el string (url en este caso)

    const [el2] = await page.$$('.price-tag-fraction');
    const txt = await el2.getProperty('textContent'); //Propiedad para obtener el texto 
    const precio = await txt.jsonValue();

    const [el3] = await page.$$('.ui-pdp-description__content');
    const txt2 = await el3.getProperty('textContent'); 
    const descripcion = await txt2.jsonValue();

    /* const [el4] = await page.$$('.ui-pdp-image');
    const img = await el4.getProperty('textContent'); 
    let imagenes = await img.jsonValue(); */
    
    console.log(imgUrl);

    /* Cierra el navegador finalizando así el proceso */
    browser.close();

    /* Notas:
     1. Usar fullXpath en caso de que Xpath no funcione
     2. Como node corre del lado del servidor, se puede automatizar el proceso 
     Obtiendo el primer item y almacenándolo en 'el' "destructuring" - $x puppeteer selector para usarlo con Xpath*
     */
}
scraprePublicacion(url);