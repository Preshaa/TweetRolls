<!DOCTYPE html>
	<html>
	<head>
	  <title>Admin Portal</title>
    <link rel="stylesheet" type="text/css" href="UserHome.css">
	  <link rel="stylesheet" type="text/css" href="Registration_login.css">
  </head>
  <body>
    <div class="main">
      <form action="setHash.php" method="post">
        <label>Set Hashtag</label>
      	<input type="text" name="hashtag" required="required"><br>
      	<input type="submit" value="Set">
      </form>
    </div>
		  <header>Welcome <?php echo $user;?></header>
		  <nav>
		  	<a href="ChangePassword.php">Change Password</a>
		  	<a href="Logout.php">Logout</a>
		  </nav>
       <?php  
        session_start();
        $user=$_SESSION['user'];
        $msg = $_GET['msg'];
        echo $msg;
      ?>
  </body>
</html>