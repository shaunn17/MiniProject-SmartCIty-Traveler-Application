<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "Smart City";

session_start();

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$email = $_SESSION['email'];
$_SESSION['email'] = $email;

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Search Review</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity=”sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I” crossorigin="anonymous">
        <link rel="stylesheet" href="css/temp.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src=”https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity=”sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/” crossorigin=”anonymous”></script>
        
    </head>
    <body>
       
        <div class="navbar">
            <div class="row">
                <div class="col-sm-4">
                    <div class="heading">
                        <h4>REVIEWS  <i class="fa fa-star"></i></h4>                        
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="liststyle">
                        <ul>
                            <li><a class="class="nav-link scrollto" href="home.html">Home</a></li>
                            <li><a class="class="nav-link scrollto" href="profile.php">Profile</a></li>
                            <li><a class="class="nav-link scrollto" href="help.html">Feedback</a></li>
                            <li><i class="fa fa-instagram"></i></li>
                            <li><i class="fa fa-github"></i></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="container1">
            
            <div class="slideshow-container">
                
                <div class="mySlides fade">
                    <img src="images/food.jpg" style="width: 1280px; height: 450px;">
                </div>
                
                <div class="mySlides fade">
                    <img src="images/restaurant.png" style="width: 1280px; height: 450px;">
                </div>

                <div class="mySlides fade">
                    <img src="images/museum.jpg" style="width: 1280px; height: 450px;">
                </div>

                <div class="mySlides fade">
                    <img src="images/garden.jpg" style="width: 1280px; height: 450px;">
                </div>

                <div class="mySlides fade">
                    <img src="images/beach.jpg" style="width: 1280px; height: 450px;">
                </div>

                <div class="mySlides fade">
                    <img src="images/visit.jpg" style="width: 1280px; height: 450px;">
                </div>
            
            </div>

            <br>
            
            <div style="text-align:center">
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
            </div>
        
            <div class="centered">
                
            
        <form action="" method="POST">
            <div class="row">
                <div class="rowchar">

                <h3>Enter the location name for reviews</h3>

                <h6>Your one and only source for honest reviews</h6>

                <div class="col">
                    <div class="colchar">
        <input type="search" name="place" placeholder="Enter location name" value="<?php echo isset($_POST['place']) ? $_POST['place'] : '' ?>"></div></div>
        <div class="col">
        <span class="icon-input-btn">
		<i class="fa fa-search"></i> 
		<input type="submit" class="btn btn-primary btn-lg" value="Search" name="submit">
        </form>
</div>
</div>  
</div>
</div>
</div>

<div class="deets">

		
<?php
if (isset($_POST['submit'])) {
    $place = $_POST['place'];
    $sql2 = "SELECT * from review WHERE id!=1 and id!=2 and place like '%$place%'";
  $result2 = $conn->query($sql2);
  

if($result2->num_rows > 0){
	echo "<div class=\"panel-group\">";
	while($row = $result2->fetch_assoc()){
		$place = $row['place'];
		$review = $row['review'];
        $rating = $row['rating'];
        $email = $row['email'];
		$sql1 = "SELECT * from signup WHERE email = '$email' limit 1";
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0){
            while($row1 = $result1->fetch_assoc()){
                $fname = $row1['fname'];
                $mname = $row1['mname'];
                $lname = $row1['lname'];

                ?>
                <hr>
                &nbsp; &nbsp; <label><i class="fa fa-user"></i> NAME: &nbsp;</label><?php echo $row1['fname']; ?> <?php echo $row1['mname']; ?> <?php echo $row1['lname']; ?><br>
                <?php
            }
        }
		
		?>
		
		
    &nbsp; &nbsp; <label><i class="fa fa-map-marker"></i> DESTINATION: &nbsp;</label><?php echo $row['place']; ?>
   
    &nbsp; &nbsp; <label style="margin-left: 200px">RATING: &nbsp;</label><?php echo $row['rating']; ?>
    
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
    
    &nbsp; &nbsp; <label>REVIEW: &nbsp;</label><?php echo $row['review']; ?><br>
    &nbsp; &nbsp; <label>IMAGE: &nbsp;</label><br>
	&nbsp; &nbsp; <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>"width="300px"/> 
<?php
}}}
	?>

</div>
    </body>

    <script>
        var slideIndex = 0;
showSlides();

function showSlides() {
var i;
var slides = document.getElementsByClassName("mySlides");
var dots = document.getElementsByClassName("dot");
for (i = 0; i < slides.length; i++) {
slides[i].style.display = "none";  
}
slideIndex++;
if (slideIndex > slides.length) {slideIndex = 1}    
for (i = 0; i < dots.length; i++) {
dots[i].className = dots[i].className.replace(" active", "");
}
slides[slideIndex-1].style.display = "block";  
dots[slideIndex-1].className += " active";
setTimeout(showSlides, 6000); // Change image every 2 seconds
}
    </script>
</html>