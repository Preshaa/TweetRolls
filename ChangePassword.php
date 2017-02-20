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
        if (isset($_POST['submit'])) {
          $password = $_POST['Password'];
          if (!empty($password)) {
              session_start();
              if (!empty($_SESSION['user'])) {              
                $user = $_SESSION['user'];            
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
          }
          else {
            echo "Enter new Password";
          }          
        }
      ?>
    </body>
  </html>