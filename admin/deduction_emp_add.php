<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		//$description = $_POST['description'];
		$amount = $_POST['amount'];
                $empid = $_POST['emploid'];
                $deductionsLst = $_POST['deductionsLst'];
                $deduct_id= explode("#", $deductionsLst);
                $deduct_id = $deduct_id[0];
		$sql = "INSERT INTO employee_deduction (emp_id, deduct_id, amount) VALUES ('$empid', '$deduct_id', '$amount')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Deduction added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: employee_deduction.php');

?>