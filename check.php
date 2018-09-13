<?php 
include ("session.php");
	if(!isset($_SESSION['name'])){
      	header("location:frontpage.html");
   	}
	if($login_session=="admin"){
		header("location:adminfrontpage.php");
	}
	else{
		header("location:homeafterlogin.php");
	}
?>