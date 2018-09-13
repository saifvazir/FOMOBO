<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>FOMOBO</title>
		<link rel="icon" type="image/icon" href="login1.png" />
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="demo.css" />
		<link rel="stylesheet" type="text/css" href="set1.css" />
		<link rel="stylesheet" type="text/css" href="frontpage.css" />
		
	</head>
	<body>
		<div class="container">
		<div class="top-button">	
		<form action='logout.php' method="post">
		<input type="submit" id="button1" class = "right"  onclick="myfunction()" value="Logout <?php include('session.php');echo $login_session;?>">
		</form>
		</div>
    <script> 
	function myfunction(){
	window.alert("Thank you for using fomobo");
	window.location="frontpage.html";
}
</script>
			<header class="heading">
				<h1><a id="fomobo"href="frontpage.html">FOMOBO <span>Food, Movies and Books!</span></a></h1>
			</header>
			<div class="content">
				<div class="grid">
					<figure class="effect">
						<img src="food.jpg" alt="food"/>
						<figcaption>
							<div>
								<h2><span>FO</span>OD</h2>
								<p>Want some? Get the Best!</p>
							</div>
							<a href="food.php"></a>
						</figcaption>			
					</figure>
					<figure class="effect">
						<img src="movie.jpg" alt="movie"/>
						<figcaption>
							<div>
								<h2><span>MO</span>VIES</h2>
								<p>You Never want to miss any!</p>
							</div>
							<a href="movie.php"></a>
						</figcaption>			
					</figure>
					<figure class="effect">
						<img src="book.jpg" alt="book"/>
						<figcaption>
							<div>
								<h2><span>BO</span>OKS</h2>
								<p>They are your real Soul!</p>
							</div>
							<a href="book.php"></a>
						</figcaption>			
					</figure>
				</div>
			</div>
			<section class="related">
				<p></p>
				<p><strong>Hope you liked the Idea!</strong></p>
				<a href="contactus.html">
					<h3>Contact Us</h3>
				</a>
				<a href="meetus.html">
					<h3>Meet the Devlopers</h3>
				</a>
			</section>
		</div>
	</body>
</html>


<!DOCTYPE html>
