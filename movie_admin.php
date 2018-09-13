<?php
include("config.php");
if(isset($_POST['name'])){ $name = $_POST['name']; } 
if(isset($_POST['writer'])){ $writer=$_POST['writer']; } 
if(isset($_POST['synopsis'])){ $synopsis=$_POST['synopsis'];}
if(isset($_POST['cast'])){ $cast=$_POST['cast'];}
if(isset($_POST['director'])){ $director=$_POST['director'];}
if(isset($_POST['awards'])){ $awards=$_POST['awards'];}
if(isset($_POST['date'])){$date=$_POST['date'];}

$target_dir = "movies/";
$target_file= $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
   
    if($check !== false ) {
        echo "File is an image - " . $check["mime"] . ".";
        
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "flv" ) {
    echo "Sorry, only mp4,flv,avi files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       // echo "The file ". $target_file1. " has been uploaded.";
        //echo "The file ". $target_file2. " has been uploaded.";
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname="fomobo";
      $conn = new mysqli($servername, $username, $password,$dbname);

      // Check connection
      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      } 
      $stmt = $conn->prepare("INSERT INTO movies(name,date,cast,awards,trailer,synopsis,director,writer) VALUES (?, ?, ?,?,?,?,?,?)");
      $stmt->bind_param("ssssssss", $name, $date, $cast,$awards,$target_file,$synopsis,$director,$writer);

      // set parameters and execute
      $stmt->execute();
      echo "<script> window.alert('you have uploaded data successfully');
             window.location='frontpage.html';
          </script>";

      $stmt->close();
      $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Movies</title>
<link rel="stylesheet" type="text/css" href="movie_admin.css">
</head>

<body>
  <form method="post" action="movie_admin.php" enctype="multipart/form-data">
    <div id="a1">
    Name:
  <input type="text" name="name" placeholder="Enter Name..">
  </div>
  <div id="a2">
  Writer:
  <input type="text" name="writer" placeholder="Enter Writer..">
  </div>
  
  <div id="a3">
    <p>Synopsis:</p>
  
    <textarea  name="synopsis" rows="7" cols="100" placeholder="Enter Synopsis..."></textarea>
  </div>
  <div id="a4">
    Cast:
  <input type="text" name="cast" placeholder="Enter Cast..">
  </div>
  <div id="a5">
   Director:
  <input type="text" name="director" placeholder="Enter Director..">
  </div>

  <div id="a6">
    Awards:
  <input type="text" name="awards" placeholder="Entre Awards..">
  </div>

  <div id="a7">
    Date:
  <input type="datetime" name="date" placeholder="yyyy-mm-dd">
  </div>

  <div id="a8">
    Trailer:
  <input type="file" name="fileToUpload">                                                                                                                                         
  </div>
  <div id="a9">
  <input type="submit" value="uploadmovieinfo">
  </div>
  
  </form>
  
</body>
</html> 