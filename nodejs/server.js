var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(3000);
io.on('connection', function (socket) {

  console.log("Client Connected");
  var redisClient = redis.createClient();
  redisClient.subscribe('message');

  redisClient.on("message", function(channel, data) {
    data = JSON.parse(data);

    //If user is not in room join room. 
    if(!socket.rooms['data.room']) {
      socket.join('data.room', function() {
        console.log('Joined room '+data.room);
                //redisClient.unsubscribe('chat'); 
      });
    }
    console.log("New message added in"+ data.room + " room");

   /*
    * Works, but dosen't emit messages to only the group. 
    * socket.in(data.room).emit(channel, data);
    */

    /*
    * Does not emit messages.
    */
    socket.broadcast.in(data.room).emit(channel, data);
    //socket.to(data.room).emit(channel, data);
  });

  socket.on('disconnect', function() {
    redisClient.quit();
  });

});