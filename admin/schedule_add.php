<?php

include 'includes/session.php';

if (isset($_POST['add'])) {
    $time_in = $_POST['time_in'];
    $time_in = date('H:i:s', strtotime($time_in));

    $time_out = $_POST['time_out'];
    $time_out = date('H:i:s', strtotime($time_out));

    $time_break_from = $_POST['time_break_from'];
    $time_break_from = date('H:i:s', strtotime($time_break_from));

    $time_break_to = $_POST['time_break_to'];
    $time_break_to = date('H:i:s', strtotime($time_break_to));

    $sql = "INSERT INTO schedules (time_in, time_out,time_break_from,time_break_to) VALUES ('$time_in', '$time_out','$time_break_from','$time_break_to')";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Schedule added successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: schedule.php');
?>