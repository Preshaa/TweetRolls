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
?>
<!DOCTYPE html>
  <html>
    <head>
      <title>Registration Page</title>
      <link rel="stylesheet" type="text/css" href="Registration_login.css">
    </head>
    <body>
      <div class="outer">
        <header>Register</header>
        <div class="main">
          <form  method="post">
            <label>Name</label>
            <input type="text" name="name"><br>
            <label>Email</label>
            <input type="email" name="email"><br>
            <label>Password</label>
            <input type="password" name="password"><br>
            <label>Gender</label>
            <select name="gender">
              <option>M</option>
              <option>F</option>
            </select><br>
            <label>Tweet Handle</label>
            <input type="text" name="tweetHandle"><br>
            <input type="submit" name="submit" value="Submit">
          </form>
        </div>
      </div>
    </body>
  </html> 
  <?php
    if (isset($_POST['submit'])) {
      require "connect.php";
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $gender = $_POST['gender'];
      $tweetHandle = $_POST['tweetHandle'];
      if (!empty($name)) {
        if (!empty($email)) {
          if (!empty($password)) {
            $hashPwd= md5($password);
            if (!empty($tweetHandle)) {
              $sql = "INSERT INTO user (name, email, password, tweetHandle, gender, roll)
              VALUES ('" . $name . "','" . $email . "','" . $hashPwd . "','" . $tweetHandle . "','" . $gender . "','user')";
              if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
              }
              else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              }
              $query = "INSERT INTO tweet_count (tweetHandle, count)
              VALUES ('" . $tweetHandle . "',0)";
              if (mysqli_query($conn, $query)) {
                echo "New record created successfully in tweet_count";
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              }
              mysqli_close($conn);
              session_start();
              $_SESSION["roll"] = "user";
              $_SESSION["user"] = $name;
              header('Location: UserHome.php'); 
            }
            else {
              echo "Enter Tweet Handle";
            }
          }
          else {
            echo "Enter Password";
          }          
        }
        else {
          echo "Enter email";
        }
      }
      else {
        echo "Enter Name";
      }
    }
  ?>