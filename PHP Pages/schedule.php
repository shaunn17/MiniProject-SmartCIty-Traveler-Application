<?php 
	
	session_start();
	include("connection.php");

	$email = $_SESSION['email'];
	$_SESSION['email'] = $email;
	
	$id = $_SESSION['id'];
	$_SESSION['id'] = $id;
    $tdate = $_POST['date'];
	$city = $_POST['city'];
	$stime = $_POST['stime'];
	$etime = $_POST['etime'];
    $choice = $_POST['choice'];

    $sql = "INSERT INTO detail(id,email,tdate,city,stime,etime,choice) 
	VALUES('$id','$email','$tdate','$city','$stime','$etime','$choice')";     
        	
    if(! $conn->query( $sql)) {
        echo 'Could not enter data: ' . $conn->error;
    }
	else{
		header('location:details.php');
	}
    $conn->close();  
	
?>