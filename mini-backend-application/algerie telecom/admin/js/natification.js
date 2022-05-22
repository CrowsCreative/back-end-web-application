const messages = document.querySelectorAll('.content-page .client-message .header .message');

messages.forEach((message, index) => {
    console.log(message.querySelector('.delete'), index);
    message.querySelector('.delete').addEventListener('click', e => {
        message.remove();
    });
});