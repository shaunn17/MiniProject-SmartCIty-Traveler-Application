<?php
session_start();
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "Smart City";

$email = $_SESSION['email'];

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

    $status = $statusMsg = ''; 
    if(isset($_POST["submit"])){ 
        $place = $_POST['place'];
        $review = $_POST['review'];
        $rating = $_POST['rating'];
        
        if(!empty($_FILES["image"]["name"])) { 
            // Get file info 
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
             
            // Allow certain file formats 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
             
                // Insert image content into database 
                $insert = $conn->query("INSERT into review (email,place,review,image,rating) VALUES ('$email','$place','$review','$imgContent','$rating')"); 
                 
                if($insert){ 
                    $status = 'success'; 
                    $statusMsg = "File uploaded successfully."; 
                    header('location:profile.php');
                }else{ 
                    $statusMsg = "File upload failed, please try again."; 
                }  
            }else{ 
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            } 
        }else{ 
            $statusMsg = 'Please select an image file to upload.'; 
        } 
    } 
     
    // Display status message 
    echo $statusMsg; 
        	
    $conn->close();  
?>

