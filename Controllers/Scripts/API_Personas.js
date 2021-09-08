/* Tener en cuenta el llamado a la API--> Qué la dirección esté bien escrita. Revisar "Network"*/
async function getUsuarios(){
    /* Para evitar error de accesso, usar proxy */
    let url = 'https://aqueous-hamlet-16379.herokuapp.com/https://api.namefake.com/spanish-spain/random'
        let res = await fetch(url, {
            /* Especificar el tipo de dato a recibir */
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
              }
        })
        .then(res => res.json())
        .then(data => console.log(data))
    
}
getUsuarios();
/* TODO: 
    1. Eliminar los prefijos de los nombres
    2. Separa el nombre completo en nombres y apellidos
    3. Crear función Generadora de Documentos de Identidad
    4. Definir campo a usar para la contraseña
    5. Definir situación con la dirección
    6. Definir Situación con la imagen
    7. Estudiar la API de MercadoLibre
*/

