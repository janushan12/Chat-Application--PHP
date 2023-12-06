const searchBar = document.querySelector('.users .search input'),
  searchBtn = document.querySelector('.users .search button'),
  usersList = document.querySelector('.users .users-list');

searchBtn.onclick = () => {
  searchBar.classList.toggle('active');
  searchBar.focus();
  searchBtn.classList.toggle('active');
  searchBar.value = '';
};

searchBar.onkeyup = () => {
  let searchTerm = searchBar.value;
  if (searchTerm === '') {
    searchBar.classList.remove('active');
  } else {
    searchBar.classList.add('active');
  }
  // lets starts Ajax
  let xhr = new XMLHttpRequest(); //Creating XML object
  //Open connection to server and send data
  xhr.open('POST', 'php/search.php', true);

  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        usersList.innerHTML = data;
      }
    }
  };
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send('searchTerm=' + searchTerm);
};

setInterval(() => {
  // lets starts Ajax
  let xhr = new XMLHttpRequest(); //Creating XML object
  //Open connection to server and send data
  xhr.open('GET', 'php/users.php', true);

  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (!searchBar.classList.contains('active')) {
          //if active not contain in serach bar then add this data
          usersList.innerHTML = data;
        }
      }
    }
  };
  xhr.send();
}, 500); //will run frequently after 500ms
