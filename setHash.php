
<?php
require_once('TwitterAPIExchange.php');
require "connect.php"; 
$settings = array(
  'oauth_access_token' => "2492829842-BFvyliEJoWuJsDdmc4UyYHt71hQYiEiv8DAVT9n",
  'oauth_access_token_secret' => "ZzDHss3Igk73cwZ2JjoXS4K9NafH7m9CMQnqpL5GSQZIJ",
  'consumer_key' => "Ue8JJ4RmlwacPEGxF3AU6TsqV",
  'consumer_secret' => "uDnGY65f2c7gQaxwSkWbOkXSnVyFvrtILR9GmhFp2fP9pTBhrz"
);
// Updating hash value
$hashtag = $_POST['hashtag']; 
$since_id = 0;
$queryV = "Update variable set value='".$hashtag."' where name='HASHTAG'";
if (mysqli_query($conn, $queryV)) {
  $flag=1;
} 
else {
  echo "Error: " . $queryV . "<br>" . mysqli_error($conn);
}
$queryID = "Update variable set value='" . $since_id . "' where name='SINCE_ID'";
if (mysqli_query($conn, $queryID)) {
  $flag+=1;
} 
else {
  echo "Error: " . $queryID . "<br>" . mysqli_error($conn);
}
$queryCount = "Update tweet_count set count='0'";
if (mysqli_query($conn, $queryCount)) {
  $flag+=1;
} 
else {
  echo "Error: " . $queryV . "<br>" . mysqli_error($conn);
}
if ($flag==3) {
      header('Location: adminHome.php?msg=Hashtag_successfully_set.');
    }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
mysqli_close($conn);
?>



