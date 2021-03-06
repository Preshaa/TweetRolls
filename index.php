<!DOCTYPE html>
  <?php require 'Header_Footer.php'; ?>
  <html>
    <head>
      <title>Tweet Rolls</title>
      <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
      <div>
        <div>
          <div>
            <table>
              <tr>
                <th>Name</th>
                <th>Twitter Handle</th>
                <th>Count</th>
              </tr>
              <?php
                if (! empty($_SESSION['roll'])) {
                  echo $_SESSION["roll"];
                  if ($_SESSION["roll"]=="admin") {
                    header('Location: adminHome.php');
                  }
                  else if ($_SESSION["roll"]=="user") {
                    header('Location: UserHome.php');
                  }
                }
                require "connect.php";
                $counter=0;
                $sql = "SELECT name, tweet_count.tweetHandle, count FROM user, tweet_count where user.tweetHandle=tweet_count.tweetHandle order by count desc";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)> 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>". $row["name"]. " </td> ";
                    echo "<td>". $row["tweetHandle"]. " </td> ";
                    echo "<td>". $row["count"]. " </td></tr> ";  
                    $counter+=$row["count"];  
                  }
                }
              ?>
            </table>
          </div>
          <div class="hash">
            <?php 
              $hashquery = "SELECT value FROM variable where name = 'HASHTAG'";
              $result = mysqli_query($conn, $hashquery);
              if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result) ;
                $hashtag = $row['value'];
              }
            ?>
            <div>HASHTAG : <?php echo $hashtag; ?></div>
            <div>Total Count : <?php echo $counter; ?></div>
          </div>
        </div>
      </div>
    </body>
  </html>