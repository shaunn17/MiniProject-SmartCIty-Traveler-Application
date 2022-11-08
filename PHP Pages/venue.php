<?php

session_start();
include('connection.php');

$email = $_SESSION['email'];
$_SESSION['email'] = $email;

$sql2 = "SELECT * from detail ORDER BY id DESC LIMIT 1";
$result2 = $conn->query($sql2);

?>
<!DOCTYPE html>
<html>
<head>
	
<title>Venues</title>
<meta charset="UTF-8">
	
	
<!--===============================================================================================-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/venue.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body onload="javascript:get_response(create_obj)">

<section>
	<div class="navbar">
		<h1 style="font-family:parkavenue, cursive"><i class="fa fa-"></i>WELCOME!</h1>
    </div>
</section>

<section class="py-5 header text-center text-white">
    <div class="container pt-4">
        <header>
            <h1 class="display-4"><strong>Venues List</strong></h1>
            <p class="font-italic mb-1">Using Foursquare API, a venue list has been generated!</p>
        </header>
    </div>
</section>

<!-- Content -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-5">
                        <h2 class="h4 mb-1">Choose a Venue!</h2>
                        <p class="font-italic">Please select a Venue you'd like to visit to proceed!</p>
                        <ul class="list-group">
                            <li class="list-group-item rounded-0">
                                <div class="custom-control custom-checkbox">
								<div class="wrap-contact3 container-fluid" id="venue1"><center>
			                        <h2 id="ven" style="margin-left: 150px"></h2>
			                         <p id="not_found"></p>                     
								</div>
							    </div>
                            </li>
                        </ul>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>

	<div class="bg-contact3">
		<div class="container-contact3 container-fluid">
			<div class="wrap-contact3 container-fluid" id="venue1"><center>
			<h2 id="ven" style="margin-left: 150px"></h2>
			<p id="not_found"></p>

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
	}
		echo "</div>";
}
?>
		
<script>
var outp1;
var date1 = '<?php echo $tdate ;?>';
var city = '<?php echo $city ;?>';
var	CLIENT_ID = "1QCUEKI3WZROHBC5QDMAPZDY5HG0FF4Q4MYXU0SMUPFYJCBX";
var CLIENT_SECRET = "R4CZQ03J5F1M0AEXLLIANKXYUCGM4JM2C4YGLRERUWLSU5P2";
var QUERY = '<?php echo $choice ;?>';
var stime = '<?php echo $stime ;?>';
var etime = '<?php echo $etime ;?>';
var YYYYMMDD = '<?php echo $sd ;?>';
var Response;
var i;
var stars = 0;

function get_response(callback){
	const Http = new XMLHttpRequest();
	const url = "https://api.foursquare.com/v2/venues/search?near="+city+"&query="+QUERY+"&client_id="+CLIENT_ID+"&client_secret="+CLIENT_SECRET+"&v="+YYYYMMDD;
		
	Http.open("GET", url);
	Http.send();
	Http.onreadystatechange=(e)=>{
		outp1 = Http.responseText;
		callback();
	}
}
var flag2 = 1;

function create_obj(){
		
		var j=1;
		Response = JSON.parse(outp1);
		console.log(outp1);
		
		if(flag2 == 1){
			
			for (i = 0; i < Response.response.venues.length; i++) {
				var id = Response.response.venues[i].id;
				var name = Response.response.venues[i].name;
				var lat = Response.response.venues[i].location.lat;
				var lng = Response.response.venues[i].location.lng;
	
	
				var outp2 = "";
		
		
				var min=3; 
				var max=9;
				var random =Math.floor(Math.random() * (+max - +min)) + +min;
				var btn = document.createElement("div");
				btn.innerHTML = name+"<br>Rating: "+random;

				btn.setAttribute("type","button");
				btn.setAttribute("id","btn"+i);
				btn.setAttribute("class", "btn btn-default btn-sm btn-block");
				
				btn.setAttribute("style","margin-left:70px; width:350px; margin-bottom:16px; color:blue; border: thick; border-color: black; background-color: #B5D5FA; font-size: 12px;");					
		
				
				btn.setAttribute("onclick","create_session('"+name+"',"+lat+","+lng+","+random+")");
				document.getElementById("venue1").appendChild(btn);
			}
			
			
			
			flag2 = 0;
		}
}

function create_session(name1, lat1, lng1,random){
	
	window.location ="location.php?name1="+name1+"&lat1="+lat1+"&lng1="+lng1+"&random="+random+"&date="+date1+"&city="+city;
}

</script>
</center>
</div>
</div>
</div>




	<div class="navbar1">
    </div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>


</body>
</html>

