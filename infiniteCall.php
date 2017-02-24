<?php
	/**
	 * To Update tweet count every 15 sec.
	 */
	while (true) {
		exec('php UpdateCount.php');
		echo "hii";
		sleep(15);
  }
?>
