const { Socket } = require('dgram');
const express = require('express');
const app = express();



/* using http */
const http = require('http').Server(app);

/* variable io */
const io = require('socket.io')(http);



const path = require('path');
/* serve the public directory */
app.use(express.static(path.join(__dirname,'public')));

/* define get function */

app.get('/',(req,res)=>{
    res.sendFile(path.join(__dirname,+'public/index.html'));
});

io.on('connection', socket=>{
    console.log('User connected');

    socket.on('disconnect',()=>{
        console.log('User Disconnected');
    });

    socket.on('message',message=>{
        console.log('message is: ',message);

        /* broadcast the message everyone */

        io.emit('message',message);
    })

});

http.listen(3000,()=>{
    console.log('listening on port 3000');
});

