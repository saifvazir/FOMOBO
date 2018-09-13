<?php
include("config.php");

$nameErr = $passErr = "";
$name = $pass= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["username"])) {
     echo "<script> window.alert('Username required');
             window.location='login.html';
          </script>";
   }
   else {
		$name = test_input($_POST["username"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			echo "<script> window.alert('Only letters allowed');
             window.location='login.html';
          </script>";
		}
   }

   if (empty($_POST["password"])) {
    echo "<script> window.alert('Password required');
             window.location='login.html';
          </script>";
   } else {
     $pass = test_input($_POST["password"]);
   }
}
$sql = "SELECT id FROM user WHERE username = '$name' and password = '$pass'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
        session_start();
         $_SESSION['name'] = $name;
        if($name=="admin")
          {
            header("location: adminfrontpage.php");
          }
        else{
             header("location:homeafterlogin.php");
        }

    }
    else{
      echo "<script> window.alert('Invalid username or password');
             window.location='login.html';
          </script>";

    }

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

