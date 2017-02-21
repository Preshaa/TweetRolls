<!DOCTYPE html>
  <?php require 'Header_Footer.php'; ?>
  <html>
    <head>
      <title>Login Portal</title>
      <link rel="stylesheet" type="text/css" href="Registration_login.css">
    </head>
    <body>
      <header class="header">Login</header>
      <div class="main">
        <form method="post">
          <label>User ID</label>
          <input type="email" name="email"><br>
          <label>Password</label>
          <input type="password" name="password"><br>
          <input type="submit" name="Login" value="Login">
          <label>Not registered?</label>
          <a href="Signup.php">Register</a>
        </form>
        <?php
          session_start();
          if (! empty($_SESSION['roll'])) {
            echo $_SESSION["roll"];
            if ($_SESSION["roll"]=="admin") {
            header('Location: adminHome.php');
            }
            else if ($_SESSION["roll"]=="user") {
              header('Location: UserHome.php');
            }
          }
          if (isset($_POST['Login'])) {
            require "connect.php";
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (!empty($email)) {
              if (!empty($password)) {
                $hashPwd= md5($password);
                $sql = "SELECT name, email, password, roll FROM user where email='".$email."' and password='".$hashPwd."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)> 0) {
                  if($row = mysqli_fetch_assoc($result)) {
                    if ($row["roll"]=="admin") {
                      session_start();
                      $_SESSION["roll"] = "admin";
                      $_SESSION["user"] = $row["name"];
                      header('Location: adminHome.php');
                    }
                    else  {
                      session_start();
                      $_SESSION["roll"] = "user";
                      $_SESSION["user"] = $row["name"];
                      header('Location: UserHome.php');
                    }
                  }
                }
                else {
                  echo "username or password is wrong!!";
                }
              }
              else {
                echo "Enter Password";
              }
            }
            else {
              echo "Enter Email";
            }
          }
        ?>
      </div>
    </body>
  </html>