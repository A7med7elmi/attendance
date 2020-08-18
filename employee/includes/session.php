<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['employee']) || trim($_SESSION['employee']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT employees.*,position.description,CONCAT(schedules.time_in,' - ',schedules.time_out) as schedule  FROM employees "
                . "inner join position on position.id=employees.position_id"
                . " inner join schedules on schedules.id=employees.schedule_id "
                . "WHERE employees.id = '".$_SESSION['employee']."' "
                . "";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
	
?>