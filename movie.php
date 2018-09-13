<?php
include("config.php");
$name=$genre="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //if (empty($_POST["search"])) {
    // echo "<script> window.alert('name required');
      //       window.location='movrev.php';
        //  </script>";
   //}
$name = test_input($_POST["search"]);
 $genre=isset($_POST['genre']) ? mysql_real_escape_string($_POST['genre']) : '';
 $language=isset($_POST['language']) ? mysql_real_escape_string($_POST['language']) : '';
}

$query = "SELECT name,cast,synopsis,director,trailer,comment,rating FROM movies,movie_reviews where  movies.movie_id=movie_reviews.movie_id and (name=? or language=? or genre=?)";

if ($stmt = $db->prepare($query)) {
 $stmt->bind_param("sss",$name,$language,$genre);
 $stmt->execute();
 $stmt->bind_result($name,$cast,$synopsis,$director,$trailer,$comment,$rating);
 $table1 = <<< TABLE
<table border="0">
  <thead><tr>
   <th>Name</th><th>Cast</th><th>Synopsis</th><th>director</th><th>Trailer</th><th>Comments</th><th>Ratings</th>
  </tr></thead>
  <tbody>
TABLE;

 while ($stmt->fetch()) {
  $table1 .= "<tr><td width='50' height='100'>$name</td><td width='150' height='100'>$cast</td><td width='200' height='100'>$synopsis</td><td width='30' height='100'>$director</td><td><video width='400' height='240' controls> <source src='$trailer' type='video/mp4'></video></td><td width='70' height='100'>$comment</td><td width='20' height='100'>$rating</td></tr>";
  
 }
 $table1 .= "</tbody></table>";

 //printf($table);
 $stmt->close();
} else {
  printf("Prepared Statement Error: %s\n", $db->error);
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
<title>MOVIE</title>
<link rel="stylesheet" type="text/css" href="movies.css">
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
				
				<h1><a id="fomobo"href="frontpage.html">MOVIES<span>All Your Favorite & Much More!</span></a></h1>
			</header>
</div>
<form method="post" action="movie.php" enctype="multipart/form-data">
  <center><input type="text" name="search" placeholder="Search..">
  <input type="submit" id="submit1" name="Search" onClick="show()">
	</center>



  <select name="language">
    <option value="">Select</option>
    <option value="Hindi">Hindi</option>
    <option value="English">English</option>
    <option value="Gujarati">Gujarati</option>
    <option value="Marathi">Marathi</option>
    
  </select>

  
 <!-- <ul>
  <li><a  href="">Thriller</a></li>
  <li><a href="">Romance</a></li>
  <li><a href="">Autobiography</a></li>
  <li><a href="">Comedy</a></li>
  <li><a href="">Horror</a></li>
  <li><a href="">Sci-Fi</a></li>
  <li><a href="">Drama</a></li>
  <li><a href="">Adventure</a></li>
  <li><a href="">Animation</a></li>
  <li><a href="">Action</a></li>
  <li><a href="">Fantasy</a></li>
  <li><a href="">Documentary</a></li>
  <li><a href="">Mystery</a></li>
</ul>
-->
<select name="genre" id="dusra">
    <option value="">Select</option>
    <option value="Thriller">Thriller</option>
    <option value="Romance">Romance</option>
    <option value="Sci-fi">Sci-fi</option>
    <option value="Fantasy">Fantasy</option>
    <option value="Drama">Drama</option>
    <option value="Adventure">Adventure</option>
    <option value="Action">Action</option>
  </select>

</form>
<br>
<br>
<br>
<div id='div1' style.display="none">
Want to enter a comment? Click on the button below!!
<form method="post" action="moviecomment_page.html">
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