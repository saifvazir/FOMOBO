<?php
include("config.php");
if(isset($_POST['name'])){ $name = $_POST['name']; } 
if(isset($_POST['author'])){ $author=$_POST['author']; } 
if(isset($_POST['summary'])){ $summary=$_POST['summary'];}
if(isset($_POST['language'])){ $language=$_POST['language'];}
if(isset($_POST['cost'])){ $cost=$_POST['cost'];}
if(isset($_POST['genre'])){ $genre=$_POST['genre'];}
if(isset($_POST['date'])){$date=$_POST['date'];}
$publication="";
$available=0;
$target_dir = "books/";
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
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
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
      $stmt = $conn->prepare("INSERT INTO books(name,author,summary,lang,publication,date,genre,cost,coverpage,available) VALUES (?, ?, ?,?,?,?,?,?,?,?)");
      $stmt->bind_param("ssssssssss", $name, $author, $summary,$language,$publication,$date,$genre,$cost,$target_file,$available);

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
<title>Books</title>
<link rel="stylesheet" type="text/css" href="book_admin.css">
</head>

<body>
  <form method="post" action="book_admin.php" enctype="multipart/form-data">
    <div id="a1">
    Name:
  <input type="text" name="name" placeholder="Enter Name..">
  </div>
  <div id="a2">
  Author:
  <input type="text" name="author" placeholder="Enter Author..">
  </div>
  
  <div id="a3">
    <p>Summary:</p>
  
    <textarea  name="summary" rows="7" cols="100" placeholder="Enter Summary..."></textarea>
  </div>
  <div id="a4">
    Language:
  <input type="text" name="language" placeholder="Enter Language..">
  </div>
  <div id="a5">
    Cost:
  <input type="text" name="cost" placeholder="Enter Cost..">
  </div>

  <div id="a6">
    Genre:
  <input type="text" name="genre" placeholder="Entre Genre..">
  </div>

  <div id="a7">
    Date:
  <input type="datetime" name="date" placeholder="yyyy-mm-dd">
  </div>

  <div id="a8">
    Coverpage:
  <input type="file" name="fileToUpload">                                                                                                                                         
  </div>
  <div id="a9">
  <input type="submit" value="uploadbookinfo">
  </div>
  
  </form>
  
</body>
</html> 