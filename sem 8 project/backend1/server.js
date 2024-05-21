// Import necessary modules
const express = require('express');
const http = require('http');
const socketIO = require('socket.io');
const bodyParser = require('body-parser');
const cors = require('cors');

// Create Express app and HTTP server
const app = express();
const server = http.createServer(app);

// Set up Socket.IO with CORS configuration
const io = socketIO(server, {
  cors: {
    origin: 'http://localhost:3000', // Replace with your frontend domain
    methods: ['GET', 'POST'],
    credentials: true,
    optionsSuccessStatus: 204,
  },
});

// Middleware to parse JSON requests
app.use(bodyParser.json());

// Standard CORS middleware
app.use(cors());

// Object to store information about active rooms
const rooms = {};

// Socket.IO event handling when a client connects
io.on('connection', (socket) => {
  console.log('User connected:', socket.id);

  // Handling 'joinRoom' event when a user wants to join a room
  socket.on('joinRoom', ({ roomId, passcode }) => {
    if (rooms[roomId] && rooms[roomId].passcode === passcode) {
      socket.join(roomId);
      socket.to(roomId).emit('userJoined', socket.id);
      rooms[roomId].participants.push(socket.id);
      socket.emit('participantsList', rooms[roomId].participants);
      socket.emit('joinedRoom', roomId); // Notify the user about successful room joining
    } else {
      socket.emit('invalidRoom');
    }
  });

  socket.on('createRoom', ({ roomId, passcode }) => {
    if (!rooms[roomId]) {
      rooms[roomId] = {
        passcode: passcode,
        participants: [socket.id],
      };
      socket.join(roomId);
      socket.emit('roomCreated', roomId);
    } else {
      socket.emit('existingRoom', rooms[roomId]); // Notify the user about the existing room
    }
  });

  // Handling 'offer' event when a user sends an offer to another user
  socket.on('offer', ({ target, caller, offer }) => {
    io.to(target).emit('offer', { target, caller, offer });
  });

  // Handling 'answer' event when a user sends an answer to another user
  socket.on('answer', ({ target, answer }) => {
    io.to(target).emit('answer', { target, answer });
  });

  // Handling 'iceCandidate' event when a user sends an ICE candidate to another user
  socket.on('iceCandidate', ({ target, candidate }) => {
    io.to(target).emit('iceCandidate', { target, candidate });
  });

  // Handling 'disconnect' event when a user disconnects
  socket.on('disconnect', () => {
    console.log('User disconnected:', socket.id);
    // Iterate through rooms to find the disconnected user and handle cleanup
    for (const roomId in rooms) {
      const index = rooms[roomId].participants.indexOf(socket.id);
      if (index !== -1) {
        rooms[roomId].participants.splice(index, 1);
        socket.to(roomId).emit('userLeft', socket.id);
        if (rooms[roomId].participants.length === 0) {
          delete rooms[roomId];
        }
        break;
      }
    }
  });
});

// Define the server's port
const PORT = 3001;

// Start the server
server.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
