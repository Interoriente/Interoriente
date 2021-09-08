async function getUsuarios(){
    let url = 'https://aqueous-hamlet-16379.herokuapp.com/https://api.namefake.com/spanish-spain/random'
        let res = await fetch(url, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
              }
        })
        .then(res => res.json())
        .then(data => console.log(data))
    
}
console.log(getUsuarios());

