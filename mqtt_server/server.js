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
    client.subscribe("teste");
});

client.on("message", async (topic, message) => {
    const payload = message.toString();
    console.log("Recebido:", payload);

    const conn = await mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "root",
        database: "the_train_db"
    });

    if (payload === "STATUS:OK") {
        await conn.execute("UPDATE trens SET quantidadePassageiros=35 WHERE id=1");
    }

    await conn.end();
});
