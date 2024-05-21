require('dotenv').config();
const express = require('express');
const http = require('http');
// const socketio = require('socket.io');
const bodyParser = require('body-parser');
const cors = require('cors');
const cookieParser = require("cookie-parser");
// const db = require('./dbConfig');
const app = express();
const server = http.createServer(app);
const sql = require('mysql');
const url = process.env.URL;
const dbConfig = require("./dbConfig");
const logUser = require("./routeing/loginUserRoute");
const exp = require('constants');
const { log } = require('console');
const { loginUser } = require('./apiutils/loginuser');
const {signupUser} = require('./apiutils/signupUser');
const {calluser} = require('./apiutils/callcode');
// const serve = http.createServer(app);
const { v4: uuidv4 } = require('uuid');
const port = process.env.PORT||3001;
const peerConnections = {};
app.use(express.json());
app.use(
  cors({
    origin: url || 'http://192.168.43.221:3000',
    methods: ["POST", "GET", "PUT"],
    credentials: true,
  })
);
app.use((req, res, next) => {
  res.setHeader("Access-Control-Allow-Origin", url);
  res.setHeader("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE");
  res.setHeader("Access-Control-Allow-Headers", "Content-Type, Authorization");
  next();
});
app.use(cookieParser());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.use("/api/login", loginUser);
app.use("/api/signup", signupUser);
// app.use("/api/profile", );

const socketidtousername = new Map();
const usernametosocketid = new Map();
const socketIO = require('socket.io')(server, {
  cors: {
      origin: "http://maskedvoice.in",
  }
});

//Add this before the app.get() block
const connectedClients = {};

socketIO.on('connection', (socket) => {
    console.log('A user connected');
    socket.on('usernamemaping', (username) => {
        usernametosocketid.set(username, socket.id);
        socketidtousername.set(socket.id, username);
        console.log(`User ${username} connected with socket ID ${socket.id}`);
        
    });
    socket.on('disconnect', () => {
        console.log('User disconnected');
        // Handle disconnection, remove user from connectedClients if needed
    });

    socket.on('callRequest', (data) => {
        console.log(data);
        const {userCallname,usernameRec, roomid} = data;
        console.log("callUsername is ",userCallname);
        const callUsernameStored = userCallname;
        console.log(callUsernameStored);
        const recipientUsername = usernameRec;
        const recipientSocketId = usernametosocketid.get(recipientUsername);
        if (recipientSocketId) {
            // Emit a call request event to the recipient's socket ID
            socket.to(recipientSocketId).emit('incomingCall', { callUsernameStored, roomid });
        } else {
            console.error(`Socket ID not found for user: ${recipientUsername}`);
        }
        // const { caller, receiver } = data;
        // console.log(`Received call request for ${calleeUsername}`);
        // Forward call request to the callee
        // const calleeSocket = connectedClients[calleeUsername];
        // if (calleeSocket) {
        //     calleeSocket.emit('incomingCall', { caller: socket.username });
        // } else {
        //     console.error(`Callee ${calleeUsername} not found`);
        // }
    });

    socket.on('callAccepted', (data) => {
        const {caller, roomidother} = data;
        console.log(`Received call acceptance from ${socket.callUsername}`);
        // Forward call acceptance to the caller
        const callerSocket = usernametosocketid.get(caller);
        if (callerSocket) {
            socket.to(roomidother).emit("user:joined", { id: socket.id });
            socket.join(roomidother);
            socket.to(callerSocket).emit('callACcepted', { caller });
        } else {
            console.error(`Caller ${socket.username} not found`);
        }

    });

    socket.on('roomtransfer', (roomidown) => {
        socket.to(roomidown).emit("user:joined", { id: socket.id });
        socket.join(roomidown);
    });
    // Handle username assignment
    socket.on("user:call", ({ to, offer }) => {
        socketIO.to(to).emit("incomming:call", { from: socket.id, offer });
      });
    socket.on("call:accepted", ({ to, ans }) => {
        socketIO.to(to).emit("call:accepted", { from: socket.id, ans });
      });
    
      socket.on("peer:nego:needed", ({ to, offer }) => {
        console.log("peer:nego:needed", offer);
        socketIO.to(to).emit("peer:nego:needed", { from: socket.id, offer });
      });
    
      socket.on("peer:nego:done", ({ to, ans }) => {
        console.log("peer:nego:done", ans);
        socketIO.to(to).emit("peer:nego:final", { from: socket.id, ans });
      });
});

// app.use("/api/friend",);
app.options('*', cors());

app.get("/",(req, res)=>{
  console.log("exex");
  res.send("Hello, get server detail");
});

console.log("I'm server, starting right now-->index.js");
server.listen(port, () => {
    console.log(`Server running on ${url}`);
});