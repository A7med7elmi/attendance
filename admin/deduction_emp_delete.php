<?php
include 'includes/session.php';
if (isset($_POST['delete'])) {
    $id = $_POST['emp_ded_id'];
    $sql = "DELETE FROM employee_deduction WHERE id = '$id'";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Deduction deleted successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Select item to delete first';
}

header('location: employee_deduction.php');
?>