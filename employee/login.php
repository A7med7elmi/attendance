<?php

session_start();
include 'includes/conn.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM employees WHERE firstname = '$username'";
    $query = $conn->query($sql);

    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'Cannot find account with the username';
    } else {
        $row = $query->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['employee'] = $row['id'];
            $_SESSION['loginTime'] = time();
            startAttendence($conn, $row['id']);
        } else {
            $_SESSION['error'] = 'Incorrect password';
        }
    }
} else {
    $_SESSION['error'] = 'Input admin credentials first';
}

function startAttendence($conn, $employee) {
    $timezone = 'Africa/Cairo';
    date_default_timezone_set($timezone);
    $date = date('Y-m-d');
    $time_in = date('H:i:s', time());

    $sql = "SELECT * FROM employees WHERE id = '$employee'";
    $query = $conn->query($sql);
    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'Employee not found';
    } else {
        $row = $query->fetch_assoc();
        $emp = $row['id'];
        //updates
        $sched = $row['schedule_id'];
        $sql = "SELECT * FROM schedules WHERE id = '$sched'";
        $squery = $conn->query($sql);
        $scherow = $squery->fetch_assoc();
        $logstatus = ($time_in > $scherow['time_in']) ? 0 : 1;
        //
        $sql = "INSERT INTO attendance (employee_id, date, time_in, status,time_out) VALUES ('$emp', '$date', '$time_in', '$logstatus','00:00:00')";
        if ($conn->query($sql)) {
            //$_SESSION['success'] = 'Attendance added successfully';
        } else {
            //$_SESSION['error'] = $conn->error;
        }
    }
}

header('location: index.php');
?>