const UUID = require('uuid');
const http = require("http");

const API_URL = 'http://localhost:80/v1/payments/add';

function l(...args) {
    let date = new Date();
    args.splice(0, 0, `[${
        ("0" + date.getHours()).slice(-2)}:${
        ("0" + date.getMinutes()).slice(-2)}:${
        ("0" + date.getSeconds()).slice(-2)}]`
    );
    console.log(...args);
}
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1) ) + min;
}

sendPayments = (() => {
    sendedCount = 0;
    for (let i = 0; i < getRandomInt(1, 10); i++) {
        let payment = {
            id: UUID.v4(),
            sum: getRandomInt(10, 500),
            commision: getRandomInt(50, 200) / 100,
            order_number: UUID.v4(),
        };
        let options = new URL(API_URL + `?json=${JSON.stringify([payment])}`)
        let request = http.request(options);

        request.on("error", console.error)
        request.end()
        l(payment);
        sendedCount++;
    }
    l('sended', sendedCount);
    setTimeout(sendPayments, 20000);
});

sendPayments();