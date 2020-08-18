<?php

include 'includes/session.php';
if (isset($_GET['return'])) {
    $return = $_GET['return'];
} else {
    $return = 'home.php';
}

if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $position = $_POST['position'];
    $schedule = $_POST['schedule'];
    $photo = $_FILES['photo']['name'];
    if (!empty($photo)) {
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $photo);
        $filename = $photo;
    } else {
        $filename = $user['photo'];
    }
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE employees SET theusername = '$username', thepassword = '$password', "
            . "gender = '$gender', position_id = '$position', schedule_id = '$schedule', "
            . "address = '$address', birthdate = '$birthdate', contact_info = '$contact', "
            . "firstname = '$firstname', lastname = '$lastname', photo = '$filename' "
            . "WHERE id = '" . $user['id'] . "'";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Employee profile updated successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up required details first';
}

header('location:' . $return);
?>