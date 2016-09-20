var socket;

jQuery(document).ready(function()
{
	socket = window.appSocket;

    socket.on('newMessage', function (newMessage) {
        alert('New message: ' + newMessage);
    });

    socket.connect(function () {
        // The socket is connected.
    });
});

function sendMessage() 
{
    var text = window.prompt('Which message would you like to send?');
    socket.send('sendMessageToOthers', text);
}