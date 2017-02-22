<?php
session_start();
?>
<!DOCTYPE html>
  <html>
    <body>
      <?php
        /**
         * Unset all the session variable and destroy current session.
         */
        session_unset();
        session_destroy();
        header('Location: index.php');
      ?>
    </body>
  </html>