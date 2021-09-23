const chatWindow = document.querySelector('.messages_right')

if (document.body.clientWidth <= 992 && window.location.search) chatWindow.classList.add('messages_active')