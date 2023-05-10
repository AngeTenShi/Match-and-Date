const socket = new WebSocket('ws://localhost:8080');
function sendMessage(username, message, destinataire) {
    const data = { username: username, message: message, destinataire: destinataire };
    socket.send(JSON.stringify(data));
}

socket.addEventListener('message', event => {
    const messagesContainer = document.querySelector('#messages');
    const data = JSON.parse(event.data);
    const messageElement = document.createElement('div');
    messageElement.innerHTML = `<strong>${data.username}:</strong> ${data.message}`;
    messagesContainer.appendChild(messageElement);
}, false);