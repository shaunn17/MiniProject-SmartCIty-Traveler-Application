<?php

session_start();
include('connection.php');

$email = $_SESSION['email'];
$_SESSION['email'] = $email;

$sql2 = "SELECT * from detail ORDER BY id DESC LIMIT 1";
$result2 = $conn->query($sql2);

?>

<html>

   <head>

        <meta charset="UTF-8">
        <meta name="description" content="Page creates a schedule">
        <meta name="keyword" content="HTML, CSS, JS, Foursquare API">
        <meta name="author" content="Rebecca, Leah, Shaun, Collin">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
		<title>Entered Details</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity=”sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I” crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/details.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	</head>

	<body>

<!-- Content -->
		<div class="bg-contact3" style="background-image: url('images/home_slider.jpg');">
			<div class="container-contact3 container-fluid">
			<div class="wrap-contact3 container-fluid">
		
<?php
if($result2->num_rows > 0){
	echo "<div class=\"panel-group\">";
	while($row = $result2->fetch_assoc()){
		$tdate = $row['tdate'];
		$stime = $row['stime'];
		$etime = $row['etime'];
		$choice = $row['choice'];
		$city = $row['city'];
		$sd = strtotime($tdate);
		
		if(strtotime(date('Y-M-D')) > $sd){
			$sql1 = "DELETE FROM detail where id='$id' AND tdate='$tdate'";
			if($conn->query($sql1)){
				header('location: home.php');
			}
		}
		else{
		
			echo "<div class=\"panel panel-warning\" style=\"border-color:black; border-radius:25px; margin-top:250px; width:800px; margin-left: 200px; border-width:10px; font-family: 'Times New Roman', Times, serif; font-size: 20px;\">
					<div class=\"panel-heading\" style=\"height: 60px; font-size: 30px\">
						<div class=\"row\" style=\"font-size:50px;\">
							<div class=\"col-md-2\"><h4><strong>Date</strong></h4></div>
							<div class=\"col-md-2\"><h4><strong>Start Time</strong></h4></div>
							<div class=\"col-md-2\"><h4><strong>End Time</strong></h4></div>
							<div class=\"col-md-2\"><h4><strong>City</strong></h4></div>
							<div class=\"col-md-2\"><h4><strong>Choice</strong></h4></div>
							<div class=\"col-md-2\"><h4><strong>Show</strong></h4></div>
						</div>
					</div>
					<div class=\"panel-body\">
						<div class=\"row\">
							<div class=\"col-md-2\">".$tdate."</div>
							<div class=\"col-md-2\">".$stime."</div>
							<div class=\"col-md-2\">".$etime."</div>
							<div class=\"col-md-2\">".$city."</div>
							<div class=\"col-md-2\">".$choice."</div>
							<div class=\"col-md-2\"><a href=\"venue.php\">Click</a></div>
						</div>
					</div>
				</div>";
		}
	}
	echo "</div>";
}
?>
<br/>
<form class="contact3-form validate-form" name="myForm" onsubmit="return validateForm()" class="login100-form validate-form"  method="POST" action="create.html">
	<center><button class="btn btn-danger" type ="submit" name="signin">
		Create New Schedule
	</button></center>
</form>

</body>
</html>