<?php

include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $time_in = $_POST['time_in'];
    $time_in = date('H:i:s', strtotime($time_in));
    $time_out = $_POST['time_out'];
    $time_out = date('H:i:s', strtotime($time_out));
    $time_break_from = $_POST['time_break_from'];
    $time_break_from = date('H:i:s', strtotime($time_break_from));

    $time_break_to = $_POST['time_break_to'];
    $time_break_to = date('H:i:s', strtotime($time_break_to));

    $sql = "UPDATE schedules SET time_in = '$time_in',time_break_from = '$time_break_from',time_break_to = '$time_break_to', time_out = '$time_out' WHERE id = '$id'";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Schedule updated successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location:schedule.php');
?>