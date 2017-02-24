<!DOCTYPE html>
  <?php require 'Header_Footer.php'; ?>
  <html>
    <head>
      <title>Home</title>
      <link rel="stylesheet" type="text/css" href="UserHome.css">
    </head>
    <body>
      <?php  
        session_start();
        $user=$_SESSION['user'];
        $msg = $_GET['msg'];
        echo $msg;
      ?>
    </body>
  </html>