<?php
  /**
   * Credentials to connect to database.
   */
  $servername = "localhost";
	$username = "root";
	$password = "mosobabu";
	$dbname = "tweetRoll";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>