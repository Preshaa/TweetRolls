<?php
  require "connect.php";
  require_once('TwitterAPIExchange.php');

  // Access Tokens to connect twitter api.
  $settings = array(
      'oauth_access_token' => "2492829842-BFvyliEJoWuJsDdmc4UyYHt71hQYiEiv8DAVT9n",
      'oauth_access_token_secret' => "ZzDHss3Igk73cwZ2JjoXS4K9NafH7m9CMQnqpL5GSQZIJ",
      'consumer_key' => "Ue8JJ4RmlwacPEGxF3AU6TsqV",
      'consumer_secret' => "uDnGY65f2c7gQaxwSkWbOkXSnVyFvrtILR9GmhFp2fP9pTBhrz"
  );

  // To retrieve hashtag.
  $hashquery = "SELECT value FROM variable where name = 'HASHTAG'";
  $result = mysqli_query($conn, $hashquery);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result) ;
    $hashtag = $row['value'];
  }

  $since_id=0;
  // To retrieve Since_ID if set in database.
  $queryID = "SELECT value FROM variable where name = 'SINCE_ID'";
  $result = mysqli_query($conn, $queryID);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result) ;
    $since_id = $row['value'];
  }

  // Using PHP Wrapper TwitterAPIExchange.php 
  $url = "https://api.twitter.com/1.1/search/tweets.json";
  $requestMethod = "GET";
  $getfield = 'q=%23'.$hashtag.'&result_type=recent&count=100&since_id='.$since_id;
  $counter = 0;
  $twitter = new TwitterAPIExchange($settings);
  $string = json_decode($twitter->setGetfield($getfield)
  ->buildOauth($url, $requestMethod)
  ->performRequest(),$assoc = TRUE);

  // Updating Since_ID from new tweets.
  if(isset($string['statuses'][0]['id'])==TRUE) {
    $since_id = $string['statuses'][0]['id'];
    $queryIDU = "Update variable set value='".$since_id."' where name='SINCE_ID'";
    if (mysqli_query($conn, $queryIDU)) {
      echo "New record created successfully in tweet_count";
    } 
    else {
      echo "Error: " . $queryIDU . "<br>" . mysqli_error($conn);
    }
  }

  // Updating count for each registered tweetHandle.
  $sql = "SELECT user.tweetHandle,count FROM user, tweet_count where user.tweetHandle=tweet_count.tweetHandle";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $counter=$row['count'];
      if (isset($string['statuses'])==true) {
        for ($i=0; $i < count($string['statuses']); $i++) { 
          if (($string['statuses'][$i]['retweet_count']==0 || isset($string['statuses'][$i]['retweeted_status'])==false) && $string['statuses'][$i]['user']['screen_name']==$row['tweetHandle']) {
            $counter++;
          }
        }
      }
      $query = "Update tweet_count set count=".$counter." where tweetHandle='".$row['tweetHandle']."'";
      if (mysqli_query($conn, $query)) {
        echo "New record created successfully in tweet_count";
      }
      else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
  } 
  else {
    echo "0 results";
  }
  mysqli_close($conn);
?>



