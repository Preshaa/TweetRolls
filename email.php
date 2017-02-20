<?php
require "connect.php";
$sql = "SELECT email from user,tweet_count where user.tweetHandle=tweet_count.tweetHandle and count=(select max(count) from tweet_count)";
$result = mysqli_query($conn, $sql);
$subject= "your tweet count is highest";
$message= "Congratulations !! keep tweeting!!";
if (mysqli_num_rows($result)> 0) {
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