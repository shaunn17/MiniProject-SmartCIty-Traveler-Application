<?php
    include('connection.php');
    session_start();
   
    $email = $_SESSION['email'];
    $_SESSION['email'] = $email;
    $sql = "SELECT * FROM signup where email = '$email'";    
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $rName = $row['username'];
        $email = $row['email'];
        $fname = $row['fname'];
        $mname = $row['mname'];
        $lname = $row['lname'];
        $dob = $row['dob'];
        $phone = $row['phone'];
        $addr = $row['addr'];

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">

    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    
    <!-- Script -->
    
    <title>Profile</title>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-dark fixed-top bg-primary flex-md-nowrap p-0 shadow"><a  class="navbar-brand col-sm-3 col-md-2 h1" style="margin-left: 20px; font-family: Roboto; font-size: 30px;" href="profile.php"> PROFILE</a>
    <h4> Welcome <?php echo $rName ?></h4>
    </nav>


        <!-- Start Container -->
    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">  <!-- Start Row -->
            <nav class="col-sm-2 bg-light sidebar py-4 shadow">
                <!-- Side Bar -->
                <div class="sidebar-sticky" style="font-size: 16px;">
                <ul class="nav flex-column">
                <li class="nav-item">
                <a class= "nav-link" href="profile.php"><i class="zmdi zmdi-account material-icons-name"></i> Profile</a>
                </li>
                <li class="nav-item-py-2">
                <a class= "nav-link" href="#reviews"><i class="zmdi zmdi-view-list"></i> My reviews</a>
                </li>
                <li class="nav-item py-2">
                <a class= "nav-link" href="direct.html"><i class="zmdi zmdi-map"></i> Get Directions</a>
                </li>
                <li class="nav-item-py-2">
                <a class= "nav-link" href="create.html"><i class="zmdi zmdi-assignment-o"></i> Create a Schedule</a>
                </li>
                <li class="nav-item-py-2">
                <a class= "nav-link" href="search.php"><i class="zmdi zmdi-view-list"></i> Reviews</a>
                </li>
                <li class="nav-item-py-2">
                <a class= "nav-link" href="home.html"><i class="zmdi zmdi-power"></i> LogOut</a>
                </li>
                </ul>
                </div>
            </nav><!-- End Side Bar -->

            <div class="col-sm-6 mt-5"> <!-- Start Profile Area -->
            <form action="trial.php" method="POST" class="mx-4">
          
            <div class="row">
            <div class="col">
            <div class="form-group">
                <label1 for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $rName ?>" readonly>
            </div>
            </div>
            <div class="col">
            <div class="form-group">
                <label1 for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" readonly>
            </div>
            </div>
            </div>

            
            <div class="row">
            <div class="col">
            <div class="form-group">
                <labell for="fname">First Name</label>
                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname ?>">
            </div>
            </div>
            <div class="col">
            <div class="form-group">
                <labell for="mname">Middle Name</label>
                <input type="text" class="form-control" name="mname" id="mname" value="<?php echo $mname ?>">
            </div>
            </div>
            <div class="col">
            <div class="form-group">
                <labell for="lname">Last Name</label>
                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $lname ?>">
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-sm-4">
            <div class="form-group">
                <label1 for="dob">Date of Birth</label>
                <input type="text" class="form-control" name="dob" id="dob" value="<?php echo $dob ?>">
            </div>
            </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                    <labell for="phone">Contact No.</label>  
                    <input id="phone" type="tel" class="form-control" name="phone" value="<?php echo $phone ?>"/>

                </div>
                </div>
            </div>
            
            <div class="form-group">
                <labell for="address">Address</label>
               <textarea class="form-control" id="address" rows="4" name="addr" value=""><?php echo $addr ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="nameupdate">Update</button>
            </form>
            </div> <!-- End Profile Area -->
        </div> <!-- End Row -->
    </div> <!-- End Container -->
</div>
<?php
}
?>

<hr id="reviews">

<div class="review">
    <h1 style="margin-left: 320px;">MY REVIEWS</h1>

<?php

$sql2 = "SELECT * from review WHERE email = '$email'";
$result2 = $conn->query($sql2);

if($result2->num_rows > 0){
	echo "<div class=\"panel-group\">";
	while($row = $result2->fetch_assoc()){
		$place = $row['place'];
		$review = $row['review'];
        $rating = $row['rating'];
        $email = $row['email'];

?>

&nbsp; &nbsp; <i class="fa fa-map-marker"></i> DESTINATION: &nbsp;</label><?php echo $row['place']; ?>
   
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; RATING: &nbsp;<?php echo $row['rating']; ?>

<?php
    $sql3 = "SELECT * from review WHERE id = 1 limit 1";
    $result3 = $conn->query($sql3);
    $remaining = 5-$rating;
    if($result3->num_rows > 0){
    while($row2 = $result3->fetch_assoc()){
        while($rating!=0){
?>

<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row2['image']); ?>"width="50px"/> 
<?php   
$rating--; 
}
    }
}

    $sql3 = "SELECT * from review WHERE id = 2 limit 1";
    $result3 = $conn->query($sql3);
    while($row2 = $result3->fetch_assoc()){
    while($remaining!=0){
?>

<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row2['image']); ?>"width="40px"/> 
 
<?php
  $remaining--;
    }
}
?>

<br>
    
    &nbsp; &nbsp; REVIEW: &nbsp;<?php echo $row['review']; ?><br>
    &nbsp; &nbsp; IMAGE: &nbsp;<br>
	&nbsp; &nbsp; <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>"width="300px"/> <hr>

<?php
    }
}

?>

</div>

<script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
      utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
  </script>



   
   
   
<!-- Script Start -->

<!-- Script End -->

</body>
</html>


