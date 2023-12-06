<?php
  session_start();
  if(isset($_SESSION['unique_id'])){ // If user logged in
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
  <body>
    <div class="wrapper">
      <section class="form login">
        <header>Realtime Chat App</header>
        <form action="#">
          <div class="error-text"></div>
          <div class="field input">
            <label>Email Address:</label>
            <input type="text" name="email" placeholder="Enter your Email" />
          </div>
          <div class="field input">
            <label>Password:</label>
            <input
              class="password-field"
              type="password"
              name="password"
              placeholder="Enter your password"
            />
            <i class="fas fa-eye toggle-password"></i>
          </div>

          <div class="field button">
            <input type="submit" value="Continue to Chat" />
          </div>
        </form>
        <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
      </section>
    </div>
    <script src="JavaScript/pass-show-hide.js"></script>
    <script src="JavaScript/login.js"></script>
  </body>
</html>
