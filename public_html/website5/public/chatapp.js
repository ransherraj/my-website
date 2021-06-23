
const messageTypes = { LEFT: 'left', RIGHT: 'right', LOGIN: 'login' };

/* chat stuffs */
const chatWindow = document.getElementById('chat');
const messagesList = document.getElementById('messagesList');
const messageInput = document.getElementById('messageInput');
const sendBtn = document.getElementById('sendBtn');

/* login stuffs */
let username = '';
const loginBtn = document.getElementById('loginBtn');
const usernameInput = document.getElementById('usernameInput');
const loginWindow = document.getElementById('login');



const messages = [
    /*  {
         author:'ransher Raj', date: '11/01/2021' , content: 'Hello! how r u?',type: messageTypes.RIGHT
     },
 
     {
         author:'mukesh', date: '11/01/2021' , content: 'i m fine',type: messageTypes.LEFT
     },
 
     {
         author:'ransher Raj', date: '11/01/2021' , content: 'cool!',type: messageTypes.RIGHT
     },
 
     {
         author:'talukdar', date: '11/01/2021' , content: 'cool!',type: messageTypes.LOGIN
     },
 
     {
         author:'talukdar', date: '11/01/2021' , content: 'cool!',type: messageTypes.LEFT
     },
 
     {
         author:'ransher Raj', date: '11/01/2021' , content: 'Hello! how r u?',type: messageTypes.RIGHT
     },
 
     {
         author:'mukesh', date: '11/01/2021' , content: 'i m fine',type: messageTypes.LEFT
     },
 
     {
         author:'ransher Raj', date: '11/01/2021' , content: 'cool!',type: messageTypes.RIGHT
     },
 
     {
         author:'talukdar', date: '11/01/2021' , content: 'cool!',type: messageTypes.LOGIN
     },
 
     {
         author:'talukdar', date: '11/01/2021' , content: 'cool!',type: messageTypes.LEFT
     } */

];
/* message contains author, date tand type */



/* linking with socket io */
var socket = io();

socket.on('message', message => {
    console.log(message);
    if (message.type !== messageTypes.LOGIN) {
        if (message.author === username) {
            message.type = messageTypes.RIGHT;
        }
        else {
            message.type = messageTypes.LEFT;
        }
    }
    messages.push(message);
    displayMessages();
    chatWindow.scrollTop = chatWindow.scrollHeight;
});


/* take messaege object and create coresponding message html */
const createMessageHTML = message => {
    if (message.type === messageTypes.LOGIN) {
        return `
        <p class="secondary-text text-center mb-2" >${message.author} has joined the chat...</p>
        `
            ;
    }
    return `<div class="message ${message.type === messageTypes.LEFT ? 'message-left' : 'message-right'}">
    <div id="message-details" class="flex">
        <p class="message-author flex-grow-1 ">${message.type === messageTypes.LEFT ? message.author : 'You'}</p> 
        
        <p class="message-date">${message.date}</p>
    </div>
    <p class="message-content">${message.content}</p>

    </div>
    `;
    /* ${message.type === messageTypes.RIGHT ? '': message.author} */
    /* can be taken above in line 74 to remove author name on right */

};

const displayMessages = () => {
    console.log('displayMessages');
    const messagesHTML = messages.map(message => createMessageHTML(message)).join('');
    messagesList.innerHTML = messagesHTML;
};





//sendBtn calling
sendBtn.addEventListener('click', (e) => {
    e.preventDefault();

    if (!messageInput.value) {
        alert('Please try to put some message before sending!!');
    }

    const date = new Date();
    const day = ('0'+ date.getDate()).slice(-2);
    const month = ('0'+ date.getMonth()+1).slice(-2);
    const year = date.getFullYear();
    

    const message = {
        author: username,
        date: `${day}/${month}/${year}`,
        content: messageInput.value,
        type: messageTypes.RIGHT
    };

    sendMessage(message);

    /* socket.emit('message',message); */


    /* messages.push(message);
    displayMessages();  */



    // default previous user message
    messageInput.value = '';

    // to bring latest messages to top

    /* chatWindow.scrollTop = chatWindow.scrollHeight; */


});


/* const sendMessage = message=>{
    socket.emit('message',message);
} */



//loginBtn calling

loginBtn.addEventListener('click', e => {

    //prevent default of the form
    e.preventDefault();

    //set the user name in array of messages and create logged in message
    if (!usernameInput.value) {
        alert('Put the valid username');
        return window.location.assign('index.html');

    }
    username = usernameInput.value;

    sendMessage({ author: username, type: messageTypes.LOGIN });

    /* console.log(username);

    messages.push({
        author: username,
        type: messageTypes.LOGIN
    }); */

    //hide the login window and display the chat window
    loginWindow.classList.add('hidden');
    chatWindow.classList.remove('hidden');

});

sendMessage=message=>{
    socket.emit('message',message);
}