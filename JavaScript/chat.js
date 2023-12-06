const form = document.querySelector('.typing-area'),
  inputField = form.querySelector('.input-field'),
  sendBtn = form.querySelector('button'),
  chatBox = document.querySelector('.chat-box');

form.onsubmit = (e) => {
  e.preventDefault(); // Preventing form submitting
};

sendBtn.onclick = () => {
  // lets starts Ajax
  let xhr = new XMLHttpRequest(); //Creating XML object
  //Open connection to server and send data
  xhr.open('POST', 'php/insert-chat.php', true);

  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = ''; //once inserted into DB then leave blank the input field
        scrollToBottom();
      }
    }
  };
  // We have to send the form data through ajax to php
  let formData = new FormData(form); //Creating new formData Object
  xhr.send(formData); //Sending the formData to php
};

chatBox.onmouseenter = () => {
  chatBox.classList.add('active');
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove('active');
};

setInterval(() => {
  // lets starts Ajax
  let xhr = new XMLHttpRequest(); //Creating XML object
  //Open connection to server and send data
  xhr.open('POST', 'php/get-chat.php', true);

  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains('active')) {
          // Active class not contains in chatbox the scroll to bottom
          scrollToBottom();
        }
      }
    }
  };
  // We have to send the form data through ajax to php
  let formData = new FormData(form); //Creating new formData Object
  xhr.send(formData); //Sending the formData to php
}, 500); //will run frequently after 500ms

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}
