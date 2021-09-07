fetch("https://api.name-fake.com/english-united-states/female/", {
})
    .then(res => res.json())
    .then(data => console.log(data));
