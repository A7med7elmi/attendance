<?php
	$conn = new mysqli('localhost:33076', 'root', 'secret', 'apsystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>