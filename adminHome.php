<!DOCTYPE html>
  <?php require 'Header_Footer.php'; ?>
  <html>
  <head>
    <title>Admin Portal</title>
    <link rel="stylesheet" type="text/css" href="UserHome.css">
    <link rel="stylesheet" type="text/css" href="Registration_login.css">
  </head>
  <body>
    <div class="main">
      <form method="post">
        <label>Set Hashtag</label>
        <input type="text" name="hashtag"><br>
        <input type="submit" value="Set" name="submit">
      </form>
    </div>
    <?php
      /**
       * After Changing Password.
       */  
      session_start();
      $user=$_SESSION['user'];
      $msg = $_GET['msg'];
      echo $msg;
    ?>
    <?php
      // Updating hashtag on click on submit button. 
      if (isset($_POST['submit'])) {
        if (!empty($_POST['hashtag'])) {
          $_SESSION['hashtag'] = $_POST['hashtag'];
          header('Location: setHash.php');
        }
        else {
          echo "Enter Hashtag";
        }
      }
    ?>
    <header class="heading">Welcome <?php echo $user;?></header>
  </body>
</html>