<?php

session_start();
include 'includes/conn.php';
endAttendence($conn);

function endAttendence($conn) {
    $timezone = 'Africa/Cairo';
    date_default_timezone_set($timezone);
    $employee = $_SESSION['employee'];
    //SELECT time_out,time_in, id AS uid FROM attendance WHERE attendance.employee_id = '$employee' ORDER BY id DESC LIMIT 1;

    $sql = "SELECT time_out,time_in, id AS uid FROM attendance WHERE attendance.employee_id = '$employee' ORDER BY id DESC LIMIT 1";
    $query = $conn->query($sql);
    if ($query->num_rows < 1) {
        $output['error'] = true;
        $output['message'] = 'Cannot Timeout. No time in.';
    } else {
        $row = $query->fetch_assoc();
        if ($row['time_out'] != '00:00:00') {
            $output['error'] = true;
            $output['message'] = 'You have timed out for today';
        } else {
            $time_logout = date('H:i:s', time());
            $sql = "UPDATE attendance SET time_out = '$time_logout' WHERE id = '" . $row['uid'] . "'";
            if ($conn->query($sql)) {
                $sql = "SELECT * FROM attendance WHERE id = '" . $row['uid'] . "'";
                $query = $conn->query($sql);
                $urow = $query->fetch_assoc();

                $time_in = $urow['time_in'];
                $time_out = $urow['time_out'];

                $sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$employee'";
                $query = $conn->query($sql);
                $srow = $query->fetch_assoc();
                $overtime = 0;
                $late = 0;
                if ($srow['time_in'] < $urow['time_in']) {
                    $late = getDifference($srow['time_in'], $urow['time_in']);
                }
                if ($srow['time_out'] < $urow['time_out']) {
                    if ($urow['time_in'] > $srow['time_out']) {
                        $overtime = getDifference($urow['time_in'], $urow['time_out']);
                    } else {
                        $overtime = getDifference($srow['time_out'], $urow['time_out']);
                    }
                }
                $int = getDifference($time_in, $time_out);
                $sql = "UPDATE attendance SET num_hr = '$int',"
                        . "overtime_hr='$overtime',late_hr='$late' WHERE id = '" . $row['uid'] . "'";
                $conn->query($sql);
            } else {
                $output['error'] = true;
                $output['message'] = $conn->error;
            }
        }
    }
}

function getDifference($timeIn, $timeOut) {
    $timeIn = new DateTime($timeIn);
    $timeOut = new DateTime($timeOut);
    $interval = $timeIn->diff($timeOut);
    $hrs = $interval->format('%h');
    $mins = $interval->format('%i');

    $mins = number_format(($mins / 60), 2);
    $int = $hrs + $mins;
    return $int;
}

session_destroy();
header('location: index.php');
?>