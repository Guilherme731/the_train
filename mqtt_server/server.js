const mqtt = require("mqtt");
const mysql = require("mysql2/promise");

var options = {
    host: '8b46e29e75014bcba8465b77629b065c.s1.eu.hivemq.cloud',
    port: 8883,
    protocol: 'mqtts',
    username: 'thetrain_esp',
    password: 'Thetrain123'
}

// initialize the MQTT client
var client = mqtt.connect(options);

client.on("connect", () => {
    console.log("Conectado ao MQTT");
    client.subscribe(["S1/Iluminacao", "S1/Temp", "S1/Presenca"]);
});

client.on("message", async (topic, message) => {
    const payload = message.toString();
    console.log("Recebido t:", topic, " m:", payload);

    const conn = await mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "root",
        database: "the_train_db"
    });

    if(topic == "S1/Iluminacao"){
        if (payload == "1") {
            await conn.execute("UPDATE estacoes SET estaChovendo=1");
        }else if(payload == "0"){
            await conn.execute("UPDATE estacoes SET estaChovendo=0");
        }
    }else if(topic == "S1/Temp"){
        await conn.execute("UPDATE estacoes SET temperatura=" + payload);
    }
    else if(topic == "S1/Presenca" && payload == "1"){
        const [rows] = await conn.execute('SELECT ordemRota, idEstacao FROM trens WHERE id = 1', [1]);
        let currentOrdem = rows.length ? rows[0].ordemRota : 0;
        //let antigaEstacao = rows.length ? rows[0].ordemRota : 0;
        if(currentOrdem >=6){
            currentOrdem = 0;
        }
        const data = new Date();
        await conn.execute("UPDATE trens SET quantidadePassageiros=" + numeroInteiroAleatorio(1,150) + ", parado=0, idEstacao=1, horaSaida='"+ data.getHours() +":" + data.getMinutes() + ":" + data.getSeconds() +"', ordemRota=" + (currentOrdem + 1) + " WHERE id=1");
    }
    //await conn.execute("UPDATE trens SET quantidadePassageiros=35 WHERE id=1");

    await conn.end();
});

function numeroInteiroAleatorio(min, max) {
return Math.floor(Math.random() * (max - min + 1)) + min;
}