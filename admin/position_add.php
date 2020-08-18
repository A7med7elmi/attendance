<?php

include 'includes/session.php';

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $rate = $_POST['rate'];
    $rate_overtime = $_POST['rate_overtime'];
    $rate_deduction = $_POST['rate_deduction'];

    $sql = "INSERT INTO position (description, rate,rate_overtime,rate_deduction) "
            . "VALUES ('$title', '$rate','$rate_overtime','$rate_deduction')";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Position added successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: position.php');
?>