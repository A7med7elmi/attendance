<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "UPDATE employees set schedule_id='0' WHERE id = '$id'";
                var_dump($sql);
		if($conn->query($sql)){
			$_SESSION['success'] = 'Schedule deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: schedule_employee.php');
	
?>