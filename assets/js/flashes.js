'use strict';

document.addEventListener("DOMContentLoaded", function() {
    const flashes = document.querySelector('.messages');

    if (null === flashes) {
        return;
    }

    const messageTemplate = flashes.querySelector('.message-template');

    const addMessage = function(type, message) {
        const m = document.importNode(messageTemplate.content, true);
        const alert = m.querySelector('.alert');

        alert.classList.add('alert-' + type);
        alert.appendChild(document.createTextNode(message));

        flashes.appendChild(m);
    };

    fetch(flashes.dataset.url)
        .then(data => data.json())
        .then(messages => {
            for (const type in messages) {
                messages[type].map(message => addMessage(type, message));
            }
        });
});
