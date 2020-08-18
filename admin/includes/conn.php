<?php
	$conn = new mysqli('206.189.196.39:33076', 'root', 'secret', 'homestead3');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>