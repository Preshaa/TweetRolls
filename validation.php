<?php
  /**
   * Validating Email.
   */
  function check_email($email){
  	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		return true;
  	}
  	else {
  		return false;
   	}
  }

  /**
   * Validating Password.
   */  
  function check_password($password){
  	$uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
		  return false;
		}
		else {
      return true;
		}
  }
?>