<?php
  /**
   * To check if session is already created.
   */
  session_start();
  if ( empty($_SESSION['roll'])) {
    header('Location: index.php');
  }
  elseif ($_SESSION["roll"]=="user") {
    header('Location: index.php');
  }
?>
<!DOCTYPE html>
  <?php require 'Header_Footer.php'; ?>
  <html>
    <head>
      <title>Outh Tokens</title>
      <link rel="stylesheet" type="text/css" href="Registration_login.css">
    </head>
    <body>
      <div class="outer">
        <header class="header">Outh Tokens</header>
        <div class="main">
          <form  method="post">
            <label>oauth_access_token</label>
            <input type="text" name="oauth_access_token"><br>
            <label>oauth_access_token_secret</label>
            <input type="text" name="oauth_access_token_secret"><br>
            <label>consumer_key</label>
            <input type="text" name="consumer_key"><br>
            <label>consumer_secret</label>
            <input type="text" name="consumer_secret"><br>
            <input type="submit" name="submit" value="Submit">
          </form>
          <?php
            /**
             * On click on submit button.
             */
            if (isset($_POST['submit'])) {
              if (!empty($oauth_access_token)) {
                if (!empty($oauth_access_token_secret)) {
                  if (!empty($consumer_key)) {
                    if (!empty($consumer_secret)) {
                        require "connect.php";
                        $query = "Update Outh_Tokens set outh_access_token='" . $_POST['oauth_access_token'] . "' and outh_access_token_secret='" . $_POST['oauth_access_token_secret'] . "' and consumer_key='" . $_POST['consumer_key'] . "' and consumer_secret='" . $_POST['consumer_secret'] ."'";
                        if (mysqli_query($conn, $query)) {
                          header('Location: UserHome.php?msg=outh_token_set');
                        }
                        else {
                          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }   
                      }
                    else {
                      echo "Enter Consumer Secret.";
                    }
                  }
                  else {
                    echo "Enter Consumer Key";
                  }
                }
                else {
                  echo "Enter Access Token Secret";
                }
              }
              else {
                echo "Enter Access Token";
              }          
            }
          ?>
        </div>
      </div>
    </body>
  </html> 