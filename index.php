<?php
  session_start();
  if(isset($_SESSION['unique_id'])){ // If user logged in
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
  <body>
    <div class="wrapper">
      <section class="form signup">
        <header>Realtime Chat App</header>
        <form action="#" enctype="multipart/form-data">
          <div class="error-text"></div>
          <div class="name-details">
            <div class="field input">
              <label>First Name:</label>
              <input name="fname" type="text" placeholder="First Name" required />
            </div>
            <div class="field input">
              <label>Last Name:</label>
              <input type="text" name="lname" placeholder="Last Name" required />
            </div>
          </div>
          <div class="field input">
            <label>Email Address:</label>
            <input type="text" name="email" placeholder="Enter your Email" required />
          </div>
          <div class="field input">
            <label>Password:</label>
            <input
              class="password-field"
              name="password"
              type="password"
              placeholder="Enter new password"
              required
            />
            <i class="fas fa-eye toggle-password"></i>
          </div>
          <div class="field input">
            <label>Re-Type Password:</label>
            <input
              class="confirm-password-field"
              name="retypePassword"
              type="password"
              placeholder="Re-type password"
              required
            />
            <i class="fas fa-eye toggle-password"></i>
          </div>
          <div class="field">
            <label>Select Image:</label>
            <input type="file" name="image" required />
          </div>
          <div class="field button">
            <input type="submit" value="Continue to Chat" />
          </div>
        </form>
        <div class="link">Already signed up? <a href="login.php">Login now</a></div>
      </section>
    </div>

    <script src="JavaScript/pass-show-hide.js"></script>
    <script src="JavaScript/signup.js"></script>
  </body>
</html>
