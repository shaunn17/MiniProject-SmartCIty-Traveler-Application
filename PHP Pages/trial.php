<?php

include('connection.php');
session_start();
$email = $_SESSION['email'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $phone = $_POST['phone'];
        $addr = $_POST['addr'];

$sql2 = "UPDATE signup set fname = '$fname', mname = '$mname', lname = '$lname', dob = '$dob', phone = '$phone', addr = '$addr' where email = '$email'";

if(! $conn->query( $sql2)) {
    echo 'Could not enter data: ' . $conn->error;
}
else{
    header('location:profile.php');
}
$conn->close();  
?>