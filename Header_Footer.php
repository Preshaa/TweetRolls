<!DOCTYPE html>
  <html>
    <head>
      <title></title>
      <link rel="stylesheet" type="text/css" href="Header_Footer.css">
    </head>
    <body>
      <header class="logo">
        <a href="index.php" class="img"><img src="images/twitter_logo.png"></a>
      </header>
      <?php
        session_start();
        if (empty($_SESSION['user'])) {
          $heading = "hidden";
          $link1 = "Signup.php";
          $link2 = "UserLogin.php";
          $link1Text = "Sign Up";
          $link2Text = "Login";
         } 
        elseif (!empty($_SESSION['user'])) {
          $user = $_SESSION['user'];
          $heading = "heading";
          $link1 = "ChangePassword.php";
          $link2 = "Logout.php";
          $link1Text = "Change Password";
          $link2Text = "Logout";
        }
      ?>
      <nav class="right_top">
        <header class=<?php echo $heading; ?>>Hii! <?php echo $user;?></header>
        <a href="index.php">Home</a>
        <a href=<?php echo $link1; ?>> <?php echo $link1Text; ?> </a>
        <a href=<?php echo $link2; ?>> <?php echo $link2Text; ?> </a>
      </nav>
      <footer>
        <span>Copyright&copy;2017</span>
      </footer>
    </body>
  </html>