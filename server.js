const app = require("express")();
var cors = require("cors");
const http = require("http").Server(app);
const io = require("socket.io")(http);
var Redis = require("ioredis");
var redis = new Redis();
var ip = require("ip");
var users = [];

app.use(cors());

http.listen(9000, function(req) {
    console.log("listening to port 9000", ip.address());
});

app.get("/", (req, res) => {
    res.json("Esta ejecutandose");
});

redis.subscribe("private-channel", function() {
    console.log("subscribe to private channel");
});

redis.on("message", function(channel, message) {
    message = JSON.parse(message);
    if (channel === "private-channel") {
        let data = message.data.data;
        let receiver_id = data.receiver_id;
        let event = message.event;

        io.to(`${users[receiver_id]}`).emit(
            `${channel}:${message.event}`,
            data
        );
    }
    console.log(message);
});

io.on("connection", function(socket) {
    socket.on("user_connected", function(user_id) {
        // alert('here')
        users[user_id] = socket.id;
        io.emit("updateUserStatus", users);
        console.log("User connected", user_id);
    });

    socket.on("disconnect", function() {
        var i = users.indexOf(socket.id);
        users.splice(i, 1, 0);
        io.emit("updateUserStatus", users);
        console.log(users);
    });
});
