<?php
include("config.php");
$name=$genre="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//  if (empty($_POST["search"])) {
  //   echo "<script> window.alert('name required');
    //         window.location='book.php';
      //    </script>";
  // }
$name = test_input($_POST["search"]);
 $genre=isset($_POST['genre']) ? mysql_real_escape_string($_POST['genre']) : '';
}

$query = "SELECT name,genre,author,lang,coverpage,comment,rating,cost,date,summary,publication FROM books,book_reviews where books.book_id=book_reviews.book_id and (name=? or genre=?) ";

if ($stmt = $db->prepare($query)) {
 $stmt->bind_param("ss",$name,$genre);
 $stmt->execute();
 $stmt->bind_result($name,$genre,$author,$language,$coverpage,$comment,$rating,$cost,$date,$summary,$publication);
 $table1 = <<< TABLE
<table border="0">
  <thead><tr>
   <th>Coverpage</th><th>Name</th><th>Genre</th><th>Author</th><th>Language</th><th>cost</th><th>date</th><th>summary</th><th>publication</th><th>Comments</th><th>Ratings</th>
  </tr></thead>
  <tbody>
TABLE;

 while ($stmt->fetch()) {

  $table1 .= "<tr><td><img src='$coverpage' style='width:300px; height:400px;'</td><td width='150' height='100'>$name</td><td width='80' height='100'>$genre</td><td width='120' height='100'>$author</td><td width='80' height='100'>$language</td><td width='40' height='100'>$cost</td><td width='50' height='100'>$date</td><td width='200' height='100'>$summary</td><td width='40' height='100'>$publication</td><td width='150' height='100'>$comment</td><td width='40' height='100'>$rating</td></tr>";
  }
 $table1 .= "</tbody></table>";

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
<title>BOOK</title>
<link rel="stylesheet" type="text/css" href="bookpage.css">
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
				
				<h1><a id="fomobo"href="frontpage.html">BOOK<span>Reading Is Breathing!</span></a></h1>
			</header>
</div>
 

<form method="post" action="book.php" enctype="multipart/form-data">
  <input type="text" name="search" placeholder="Search..">
  <input type="submit" id="submit1" name="Search" onClick="show()" >

  <select name="genre" >
    <option value="">Select Type</option>
    <option value="Mystery">Mystery</option>
    <option value="Biography">Biography</option>
    <option value="Children's">Books for children</option>
    <option value="Thriller">Thriller</option>
    <option value="Classic">Classic</option>
    <option value="Romance">Romance</option>
    <option value="Fantasy">Fantasy</option>
    <option value="Horror">Horror</option>
    <option value="Fiction">Fiction</option>
    
  </select>

</form>
<br>
<br>

<div id='div1' style.display="none">
Want to enter a comment? Click on the button below!!
<form method="post" action="bookcomment_page.html">
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