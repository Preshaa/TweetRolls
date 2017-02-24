<?php
  require "connect.php";
  require_once('TwitterAPIExchange.php');

  // To retrieve Outh Tokens.
  $hashquery = "SELECT outh_access_token, outh_access_token_secret, consumer_key, consumer_secret FROM Outh_Tokens";
  $result = mysqli_query($conn, $hashquery);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result) ;
    $oauth_access_token = $row['outh_access_token'];
    $oauth_access_token_secret = $row['outh_access_token_secret'];
    $consumer_key = $row['consumer_key'];
    $consumer_secret = $row['consumer_secret'];
  }
  
  // Access Tokens to connect twitter api.
  $settings = array(
      'oauth_access_token' => $oauth_access_token,
      'oauth_access_token_secret' => $oauth_access_token_secret,
      'consumer_key' => $consumer_key,
      'consumer_secret' => $consumer_secret
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

  $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
  fwrite($myfile, json_encode($string));

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



