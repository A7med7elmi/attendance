<?php
include 'includes/session.php';
if (isset($_POST['add'])) {
    $code = $_POST['employee'];
    $amount = $_POST['amount'];
    $deduction = $_POST['deduction'];
    $sql = "SELECT * FROM employees WHERE employee_id = '$code'";
    $query = $conn->query($sql);
    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'Employee not found';
    } else {
        $row = $query->fetch_assoc();
        $employee_id = $row['id'];
        $sql = "INSERT INTO cashadvance (employee_id, date_advance, amount,monthly_deduction) VALUES ('$employee_id', NOW(), '$amount','$deduction')";
        if ($conn->query($sql)) {
            $_SESSION['success'] = 'Cash Advance added successfully';
        } else {
            $_SESSION['error'] = $conn->error;
        }
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}
header('location: cashadvance.php');
?>