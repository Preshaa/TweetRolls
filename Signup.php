<?php
  /**
   * To check if session is already created.
   */
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
    include "validation.php";

    // On click on submit button.
    if (isset($_POST['submit'])) {
      require "connect.php";
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $gender = $_POST['gender'];
      $tweetHandle = $_POST['tweetHandle'];

      // Checking if inputs are empty, not correct or already exists.
      if (!empty($name)) {
        if (!empty($email)) {
          if(check_email($email)) {
            if (!empty($password)) {
              if (check_password($password)) {

                // Converting Password into Hashcode.
                $hashPwd= md5($password);
                
                if (!empty($tweetHandle)) {
                  if (checkExistence($email, $tweetHandle)) {
    
                    // Inserting user data in database.
                    $sql = "INSERT INTO user (name, email, password, tweetHandle, gender, roll)
                    VALUES ('" . $name . "','" . $email . "','" . $hashPwd . "','" . $tweetHandle . "','" . $gender . "','user')";
                    if (mysqli_query($conn, $sql)) {
                      echo "New record created successfully";
                    }
                    else {
                      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }

                    // Setting tweet count to 0 for that user.
                    $query = "INSERT INTO tweet_count (tweetHandle, count)
                    VALUES ('" . $tweetHandle . "',0)";
                    if (mysqli_query($conn, $query)) {
                      echo "New record created successfully in tweet_count";
                    } else {
                      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }

                    mysqli_close($conn);
                    
                    // On Registering, Starting a session for that user.
                    session_start();
                    $_SESSION["roll"] = "user";
                    $_SESSION["user"] = $name;
                    header('Location: UserHome.php');
                  }
                  else {
                    echo "Email or Tweet Handle already exist.";
                  } 
                }
                else {
                  echo "Enter Tweet Handle";
                }
              }
              else {
                echo "Password must contain atleast 1 uppercase, 1 lowercase, 1 digit and atleast 8 characters.";
              }
            }
            else {
              echo "Enter Password";
            }
          }
          else {
            echo "Enter correct email id.";
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

    /**
     * To check if email or tweetHandle already exists in database.
     */
    function checkExistence($email, $tweetHandle) {
      $sql = "SELECT name, email, password, roll FROM user where email='".$email."' and password='".$hashPwd."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result)> 0) {
        return true;
      }
      else {
        return false;
      }
    }
  ?>