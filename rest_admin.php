<?php
include("config.php");
if(isset($_POST['name'])){ $name = $_POST['name']; } 
if(isset($_POST['phone'])){ $phone=$_POST['phone']; } 
if(isset($_POST['address'])){ $address=$_POST['address'];}
if(isset($_POST['zone'])){ $zone=$_POST['zone'];}
if(isset($_POST['cost'])){ $cost=$_POST['cost'];}
if(isset($_POST['email'])){ $email=$_POST['email'];}
if(isset($_POST['cuisine'])){$cuisine=$_POST['cuisine'];}

$target_dir = "restro/";
$target_file1 = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
$target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
$uploadOk = 1;
$imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
$imageFileType2 = pathinfo($target_file2,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check1 = getimagesize($_FILES["fileToUpload1"]["tmp_name"]);
    $check2 = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
    if($check1 !== false || $check2!==false) {
        echo "File is an image - " . $check1["mime"] . ".";
        echo "File is an image - " . $check2["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file1)||file_exists($target_file2)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload1"]["size"] > 50000000||$_FILES["fileToUpload2"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
&& $imageFileType1 != "gif"&& $imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg"
&& $imageFileType2 != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1)&&move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2)) {
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
      $stmt = $conn->prepare("INSERT INTO restaurants(name,phone, zone,address,email_id,menu,photo,cuisine,cost) VALUES (?, ?, ?,?,?,?,?,?,?)");
      $stmt->bind_param("sssssssss", $name, $phone, $zone,$address,$email,$target_file2,$target_file1,$cuisine,$cost);

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
<title>Restaurants</title>
<link rel="stylesheet" type="text/css" href="rest_admin.css">
</head>

<body>
  <form action="rest_admin.php" method="post" enctype="multipart/form-data">
    <div id="a1">
    Name:
  <input type="text" name="name" placeholder="Enter Name..">
  </div>
  <div id="a2">
  Phone:
  <input type="text" name="phone" placeholder="Enter Phone..">
  </div>
  
  <div id="a3">
  <p>Address:</p>

    <textarea  name="address" rows="5" cols="80" placeholder="Enter Address..."></textarea>
  </div>
  <div id="a4">
    Zone:
  <input type="text" name="zone" placeholder="Enter Zone..">
  </div>
  <div id="a5">
    Cost:
  <input type="text" name="cost" placeholder="Enter Cost..">
  </div>
  <div id="a6"> 
    Email Id:
  <input type="text" name="email" placeholder="Enter Email Id..">
  </div>
  <div id="a7">
    Cuisine:
  <input type="text" name="cuisine" placeholder="Enter Cuisine..">
  </div>
  <div id="a8">
    Coverpage:
  <input type="file" name="fileToUpload1">  

  </div>
  <div id="a9">
    Menu:
  <input type="file" name="fileToUpload2">
  </div>                                                                                    
  <div id="a10">
  <input type="submit" value="uploadrestaurantinfo">
     </div>
  
  </form>
  
</body>
</html> 