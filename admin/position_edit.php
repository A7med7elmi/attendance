<?php

include 'includes/session.php';
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $rate = $_POST['rate'];
    $rate_overtime = $_POST['rate_overtime'];
    $rate_deduction = $_POST['rate_deduction'];

    $sql = "UPDATE position SET description = '$title', rate = '$rate' , rate_overtime = '$rate_overtime', rate_deduction = '$rate_deduction'"
            . "WHERE id = '$id'";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Position updated successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up edit form first';
}
header('location:position.php');
?>