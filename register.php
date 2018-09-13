<?php
// define variables and set to empty values
$nameErr = $passErr = $emailErr=$unameErr=$cpassErr=$phoneErr="";
$name = $pass= $email=$uname=$cpass=$phone="";
$flag=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     echo "<script> window.alert('Name required');
             window.location='signup.html';
          </script>";
        $flag=1;
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       echo "<script> window.alert('Only letters and spaces allowed');
             window.location='signup.html';
          </script>";
          $flag=1;
     }
   }
   if (empty($_POST["username"])) {
     echo "<script> window.alert('Username required');
             window.location='signup.html';
          </script>";
          $flag=1;
   } else {
     $uname = test_input($_POST["username"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$uname)) {
       echo "<script> window.alert('Only letters allowed');
             window.location='signup.html';
          </script>";
          $flag=1;
     }
   }
   if (empty($_POST["email"])) {
     echo "<script> window.alert('Email id required');
             window.location='signup.html';
          </script>";
          $flag=1;
   } else {
     $email= test_input($_POST["email"]);
   }
 if (empty($_POST["password"])) {
    echo "<script> window.alert('password required');
             window.location='signup.html';
          </script>";
          $flag=1;
   } 
   else {
     $pass = test_input($_POST["password"]);
   }

if (empty($_POST["cpassword"])) {
    echo "<script> window.alert('confirmed password required');
             window.location='signup.html';
          </script>"; 
          $flag=1;
   } else {
     $cpass = test_input($_POST["cpassword"]);
   }

if (empty($_POST["mobile"])) {
     echo "<script> window.alert('phone number required');
             window.location='signup.html';
          </script>";
          $flag=1;
   }
else {
     $phone = test_input($_POST["mobile"]);
      if (!preg_match("/^[0-9]*$/",$phone)) {
       echo "<script> window.alert('Only numbers allowed');
             window.location='signup.html';
          </script>";
          $flag=1;
     }
   }
}
if($cpass!=$pass){
  echo "<script> window.alert('Confirmed password should be same as password, please re-enter details');
             window.location='signup.html';
          </script>";
          $flag=1;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname="fomobo";

// Create connection
if($flag==0){
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$stmt = $conn->prepare("INSERT INTO user(username, email_id, password,name,phone) VALUES (?, ?, ?,?,?)");
$stmt->bind_param("sssss", $uname, $email, $pass,$name,$phone);

// set parameters and execute
$stmt->execute();
echo "<script> window.alert('Congrats, you have registered successfully');
             window.location='login.html';
          </script>";

$stmt->close();
$conn->close();
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>


