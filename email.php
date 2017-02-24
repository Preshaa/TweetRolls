<?php
  require "connect.php";
  $query = "select value from variable where name='HASHTAG'";
  $resultHash = mysqli_query($conn, $query);
  if (mysqli_num_rows($resultHash) > 0) {
    while ($rowHash = mysqli_fetch_assoc($resultHash)) {
      $HASHTAG = $rowHash['value'];
    } 
  }
  $sql = "select email from tweet_count,user where user.tweetHandle = tweet_count.tweetHandle order by count desc limit 2";
  $result = mysqli_query($conn, $sql);
  $subject = "your tweet count is highest";
  $message = "Congratulations !! keep tweeting!! For HASHTAG : ".$HASHTAG;
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      echo $row['email'];
      $to = $row["email"];
      mail($to,$subject,$message);
    }
  } 
  else {
    echo "0 results";
  }
  mysqli_close($conn);
?>  