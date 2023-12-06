const passwordFields = document.querySelectorAll(
    ".form input[type='password']"
  ),
  toggleIcons = document.querySelectorAll('.form .field .toggle-password');

toggleIcons.forEach((icon, index) => {
  icon.onclick = () => {
    const passwordField = passwordFields[index];
    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      icon.classList.add('active');
    } else {
      passwordField.type = 'password';
      icon.classList.remove('active');
    }
  };
});
