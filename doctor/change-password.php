<?php
session_start();

include '../connection.php';


if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {

    header('Location: index.php');
    exit();
}

$newPassword = $_POST['newpassword'];
$confirmPassword = $_POST['c_newpassword'];

//check the both pass match or not
if ($newPassword !== $confirmPassword) {
    die("New password and confirm password do not match.");
}


$doctorEmail = $_SESSION['email']; 
$updateQuery = "UPDATE doctors SET doctor_password = '$newPassword', confirm_password='$newPassword' WHERE email = '$doctorEmail'";
$updateResult = mysqli_query($con, $updateQuery);

if ($updateResult) {
    echo "Password updated successfully.";
} else {
    echo "Failed to update password.";
}
header('location: index.php');

mysqli_close($con);


