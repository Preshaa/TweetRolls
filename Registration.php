<?php
require "connect.php";
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$tweetHandle = $_POST['tweetHandle'];
$hashPwd= md5($password);
$sql = "INSERT INTO user (name, email, password, tweetHandle, gender, roll)
VALUES ('".$name."','".$email."','".$hashPwd."','".$tweetHandle."','".$gender."','user')";
if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
}
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$query = "INSERT INTO tweet_count (tweetHandle, count)
VALUES ('".$tweetHandle."',0)";
if (mysqli_query($conn, $query)) {
//  echo "New record created successfully in tweet_count";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
header('Location: UserLogin.php');
?>