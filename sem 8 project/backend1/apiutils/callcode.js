const jwt = require("jsonwebtoken");
const con = require("../dbConfig");
const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

async function calluser(req, res) {

    // const { connectionId } = req.params;
    // const { sender, receiver, signal } = req.body;

    // // Find recipient peer
    // const recipient = peerConnections[receiver][connectionId];

    // // Forward signaling message to recipient
    // if (recipient) {
    //     // Send signaling message to recipient
    //     // This could be done using a WebSocket connection or any other means of communication
    // } else {
    //     res.status(404).json({ message: 'Recipient not found' });
    // }


    io.on('connection', (socket) => {
        console.log('A user connected');
      
        socket.on('disconnect', () => {
          console.log('User disconnected');
        });
      
        // Signaling events
        socket.on('offer', (data) => {
          console.log('Received offer:', data);
          io.emit('offer', data);
        });
      
        socket.on('answer', (data) => {
          console.log('Received answer:', data);
          io.emit('answer', data);
        });
      
        socket.on('ice-candidate', (data) => {
          console.log('Received ICE candidate:', data);
          io.emit('ice-candidate', data);
        });
      });
}

module.exports = {
  calluser,
};
