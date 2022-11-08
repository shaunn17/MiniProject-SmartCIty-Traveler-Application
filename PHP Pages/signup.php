<?php
session_start();
$email = $_POST['email'];
$_SESSION['email'] = $email;
$username = $_POST['username'];
$pass = $_POST['pass'];
$re_pass = $_POST['re_pass'];

if (!empty($username) || !empty($email) || !empty($pass) || !empty($re_pass)) 
{
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "Smart City";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);
    else 
    {
        $SELECT = "SELECT username,email From signup Where email = '$email' Limit 1";
        $INSERT = "INSERT INTO signup (username, email, pass, re_pass) values ('$username', '$email', '$pass', '$re_pass')";
        #echo $INSERT;
        //Prepare statement 
        $stmt = $conn->prepare($SELECT);
        #$stmt-> bind_param("s", $email);
       
        $stmt-> execute();
        #$stmt-> bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0) 
        {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            #echo $stmt;
            #$stmt->bind_param("ssss",$uname, $email, $pass, $re_pass);
            $stmt->execute();
            header( "refresh:1; url=profile.php");
            echo '<script>alert("New record inserted successfully")</script>';
        }
    
        else 
        {
            header( "refresh:1; url=signup.html");
            echo '<script>alert("Someone already registered using this email")</script>';
        }
    $stmt->close();
    $conn->close();
    }
}
else 
{
    echo "All fields are required";
    die();
}

?>