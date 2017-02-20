
<?php
  // Updating hash value.
  $hashtag = $_POST['hashtag']; 
  $since_id = 0;
  $queryV = "Update variable set value='".$hashtag."' where name='HASHTAG'";
  if (mysqli_query($conn, $queryV)) {
    $flag=1;
  } 
  else {
    echo "Error: " . $queryV . "<br>" . mysqli_error($conn);
  }

  // Updating Since_id.
  $queryID = "Update variable set value='" . $since_id . "' where name='SINCE_ID'";
  if (mysqli_query($conn, $queryID)) {
    $flag+=1;
  } 
  else {
    echo "Error: " . $queryID . "<br>" . mysqli_error($conn);
  }

  // Updating tweet_count table, initialising it with 0.
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



