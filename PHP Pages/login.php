<?php
session_start();
$email = $_POST['email'];
$_SESSION['email'] = $email;
$pass = $_POST['pass'];


if (!empty($username) || !empty($pass)) 
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
        $SELECT = "SELECT username,pass From signup Where email = '$email' AND pass = '$pass' Limit 1";
        
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
        

            header( "refresh:1; url=signup.html" );
            echo '<script>alert("User doesnt exist")</script>';
        }
    
        else 
        {
            
            echo '<script>alert("Login Successful!!!")
            </script>';
            header( "refresh:1; url=profile.php");
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