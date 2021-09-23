const mysql = require('mysql');

const con = mysql.createConnection({
    host: "190.90.160.12", 
    user: "interori_interori",
    password: "B4O#ugJ]C#%,4",
    database: "interori_interoriente"
});

con.connect(function (err) {
    if (err) throw err; 
    console.log("Conexión Exitosa");
    const sql = "SELECT * FROM tblLinks WHERE estado = 0 LIMIT 1";
    con.query(sql, function(err, result, fields){
        if (err) throw err;
        let id = result[0].id;
        let link = result[0].url;
        let categoria = result[0].categoria
        console.log(link);
        
    });
})
