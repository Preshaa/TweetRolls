<!DOCTYPE html>
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
		  <header>Welcome <?php echo $user;?></header>
		  <nav>
		  	<a href="ChangePassword.php">Change Password</a>
		  	<a href="Logout.php">Logout</a>
		  </nav>
		</body>
	</html>