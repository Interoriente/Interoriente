async function getUsuarios(){
    let url = 'https://api.name-fake.com/english-united-states/female/'
    try{
        let res = await fetch(url);
        return await res.json();
    }catch(error){
        console.log(error);
    }
}
getUsuarios();

