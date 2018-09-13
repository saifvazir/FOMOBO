<?php 
include ("session.php");
	if(!isset($_SESSION['name'])){
		 echo "<script> window.alert('You need to login to post a comment :)');
           window.location='login.html';
         </script>";
      	
   	}
	
	
?>