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
        /**
         * Checking existence of Session.
         */
        session_start();
        if (empty($_SESSION['user'])) {
          header('Location: index.php');
        }
      ?>

      <?php
        /**
         * On click on submit button.
         */
        include "validation.php";
        if (isset($_POST['submit'])) {
          $password = $_POST['Password'];
          // Password must be in correct format and must not be empty.
          if (!empty($password)) {
            if (check_password($password)) {
              session_start();
              if (!empty($_SESSION['user'])) {              
                $user = $_SESSION['user']; 
                // Updating password in database by converting it in hashcode.           
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
              echo "Password must contain atleast 1 uppercase, 1 lowercase, 1 digit and atleast 8 characters.";
            }
          }
          else {
            echo "Enter new Password";
          }          
        }
      ?>
    </body>
  </html>