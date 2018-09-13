<?php
include("config.php");
$name=$phone=$address=$cuisine=$zone="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // if (empty($_POST["search"])) {
   //  echo "<script> window.alert('name required');
     //        window.location='food.php';
       //   </script>";
   //}
//$name = test_input($_POST["search"]);
$name=isset($_POST['search']) ? mysql_real_escape_string($_POST['search']) : "";
$zone=isset($_POST['location']) ? mysql_real_escape_string($_POST['location']) : '';
$cuisine=isset($_POST['cuisine']) ? mysql_real_escape_string($_POST['cuisine']) : '';
}

echo $zone;
  $query = "SELECT name,zone,address,cuisine,menu,photo,comment,rating FROM restaurants,food_reviews where restaurants.rest_id=food_reviews.rest_id and (name=? or zone=? or cuisine=?)";

if ($stmt = $db->prepare($query)) {
  
     $stmt->bind_param("sss",$name,$zone,$cuisine);
   
 $stmt->execute();
 $stmt->bind_result($name,$zone,$address,$cuisine,$menu,$photo,$comment,$rating);
$table1 = <<< TABLE
<table border="0">
  <thead><tr>
   <th>Photo</th><th>Name</th><th>Zone</th><th>Address</th><th>Cuisine</th><th>Menu</th><th>Comments</th><th>Ratings</th>
  </tr></thead>
  <tbody>
TABLE;

 while ($stmt->fetch()) {
  $table1 .= "<tr><td align='center' ><img src='$photo' style='width:200px; height:275px;'</td><td align='center' width='125' height='100' >$name</td><td align='center' width='75' height='100'>$zone</td><td align='center' width='225' height='100'>$address</td><td align='center' width='85' height='100'>$cuisine</td><td align='center'><img src='$menu' style='width:200px; height:275px;'</td><td align='center' width='85' height='100'>$comment</td><td align='center' width='35' height='100'>$rating</td></tr>";
 
 }
 $table1 .= "</tbody></table>";

 $stmt->close();
} else {
  printf("Prepared Statement Error: %s\n", $mysqli->error);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>FOOD</title>
<link rel="stylesheet" type="text/css" href="foodpage.css">
<link rel="icon" type="image/icon" href="login1.png" />
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="demo.css" />
		<link rel="stylesheet" type="text/css" href="set1.css" />
		<link rel="stylesheet" type="text/css" href="frontpage.css" />
		
</head>

<body>
<div class="container">
			<div class="top-button">
					
			<form action="check.php">
				<input type="submit" id ="button1" name="Home" value="Home" >
			</form>
			</div>
			<header class="heading">
				
				<h1><a id="fomobo"href="frontpage.html">FOOD<span>Now You're Eating!</span></a></h1>
			</header>
</div>
<form method="POST" action="food.php" enctype="multipart/form-data">
 
	 <center><input type="text" name="search" placeholder="" value="">
  <input type="submit" id ="submit1"name="Search" onclick="show()" >
</center>
 <select name="location">
    <option value="">Select Location</option>
    <option value="South Mumbai">South Mumbai</option>
    <option value="Western Suburbs">Western Suburbs</option>
    <option value="Central Mumbai">Central Mumbai</option>
    
 </select>
 <!--<ul>
  <li><a class="active" href="">Cuisine</a></li>
  <li><onclick="window.location.href='foodrev.php?cuisine=Chinese'">Chinese</li>
  <li><input type="hidden" name ="cuisine" value="North Indian">North Indian</li>
  <li><input type="hidden" name ="cuisine" value="South Indian">South Indian</li>
  <li><input type="hidden" name ="cuisine" value="Desserts">Desserts</li>
  <li><input type="hidden" name ="cuisine" value="taliIan">Italian</li>
  <li><input type="hidden" name ="cuisine" value="Burgers">Burgers</li>
  <li><input type="hidden" name ="cuisine" value="Bars">Bars</li>
  <li><input type="hidden" name ="cuisine" value="Cafe">Cafe</li>
  <li><a href="">Sea food</a></li>
  <li><a href="">Street food</a></li>
  <li><a href="">Icecream</a></li>
  <li><a href="">Maharashtrain</a></li>
  <li><a href="">Bakery</a></li>
<li><a href="">Juices</a></li>

</ul>
-->
<select name="cuisine" id="dusra">
    <option value="">Select Cuisine</option>
    <option value="Chinese">Chinese</option>
    <option value="North Indian">North Indian</option>
    <option value="South Indian">South Indian</option>
    <option value="Desserts">Desserts</option>
    <option value="Italian">Italian</option>
    <option value="Burgers">Burgers</option>
    <option value="Bars">Bars</option>
    <option value="Cafe">Cafe</option>
    <option value="Sea food">Sea food</option>
    <option value="Icecream">Icecream</option>
    <option value="Maharashtrian">Maharashtrain</option>
    <option value="Bakery">Bakery</option>
    <option value="Juices">Juices</option>
    
 </select>
</form>
<br>
<br>
<br>
<div id='div1' style.display="none">
Want to enter a comment? Click on the button below!!
<form method="post" action="foodcomment_page.html">
  <input type="submit" name="comment" value="submit">
</form>
<?php echo $table1;
      
 ?>
</div>


<script>
function show(){
  document.getElementById('div1').style.display = 'block';
}
</script>

</body>
</html> 