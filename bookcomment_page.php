<?php
include("config.php");


if(isset($_POST['name'])){ $name = $_POST['name']; } 
if(isset($_POST['rating'])){ $rating=$_POST['rating']; } 
if(isset($_POST['comment'])){ $comment=$_POST['comment'];}

$uploadOk = 1;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
 
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname="fomobo";
      $conn = new mysqli($servername, $username, $password,$dbname);

      // Check connection
      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      } 
      $query="Select book_id from books where name=?";
      if ($stmt1 = $db->prepare($query)) {
  
            $stmt1->bind_param("s",$name);
   
            $stmt1->execute();
            $stmt1->bind_result($book_id);
            $stmt1->fetch();
            
            $stmt1->close();
      }else {
          printf("Prepared Statement Error: %s\n", $mysqli->error);
            }

      if( $conn->query("UPDATE book_reviews SET comment='$comment', rating='$rating' where book_id='$book_id'")==true){
      // set parameters and execute
        //$conn->query("UPDATE book_reviews SET comment='.$comment.', rating='.$rating.' where book_id='.$book_id.'");
      echo "<script> window.alert('you have uploaded data successfully');
             window.location='frontpage.html';
          </script>";
        }
        else{
            echo "Error updating record: " . $conn->error;
        }
        $conn->close();
      
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Comment page</title>
<link rel="stylesheet" type="text/css" href="book_admin.css">
</head>

<body>
  <form method="post" action="bookcomment_page.php" enctype="multipart/form-data">
    <div id="a1">
    Name:
  <input type="text" name="name" placeholder="Enter Name..">
  </div>
  <div id="a2">
  Rating:
  <input type="text" name="rating" placeholder="Enter Rating">
  </div>
  
  <div id="a3">
    <p>Comment please:</p>
  
    <textarea  name="comment" rows="7" cols="100" placeholder="Enter comment..."></textarea>
  </div>
  
  <div id="a4">
  <input type="submit" value="upload comment">
  </div>
  </form>
  
</body>
</html> 