<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
</head>
<body>
  <form  method="post">
  	<label>New Password</label>
  	<input type="Password" name="Password">
  	<input type="submit" name="submit" value="submit">
  </form>


<?php
  if (isset($_POST['submit']))
  {
  session_start();
  $user = $_SESSION['user'];
  $password = $_POST['Password'];
  $hashPwd = md5($password);
  require "connect.php";
  $query = "Update user set password='" . $hashPwd . "' where name='" . $user . "'";
    if (mysqli_query($conn, $query)) {
      header('Location: UserHome.php?msg=password_changed');
    }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    }
?>

</body>
</html>