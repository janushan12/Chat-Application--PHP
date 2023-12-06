const form = document.querySelector('.login form'),
  continueBtn = form.querySelector('.button input'),
  errorText = form.querySelector('.error-text');

form.onsubmit = (e) => {
  e.preventDefault(); //Preventing form from submitting
};
continueBtn.onclick = () => {
  // lets starts Ajax
  let xhr = new XMLHttpRequest(); //Creating XML object
  //Open connection to server and send data
  xhr.open('POST', 'php/login.php', true);

  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        console.log(data);
        if (data === 'Success') {
          location.href = 'users.php';
        } else {
          errorText.textContent = data;
          errorText.style.display = 'block';
        }
      }
    }
  };
  // We have to send the form data through ajax to php
  let formData = new FormData(form); //Creating new formData Object
  xhr.send(formData); //Sending the formData to php
};
