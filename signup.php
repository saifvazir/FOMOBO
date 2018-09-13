<html>
<head>
<meta charset="utf-8">
<title>FO.MO.BO</title>
<style type="text/css">
body {
background-color: white;
color: #5a5656;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-size: 16px;
line-height: 1.5em;
}
a { text-decoration: none; }
h1 { font-size: 1em; }
h1, p {
margin-bottom: 10px;
}
strong {
font-weight: bold;
}
.uppercase { text-transform: uppercase; }

#Submit {
margin: 100px auto;
width: 680px;
}
form fieldset input[type="text"], input[type="password"] {
background-color: lightgrey;
margin : 10px;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #5a5656;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-size: 14px;
height: 43px;
outline: none;
padding: 0px 10px;
width: 300px;
-webkit-appearance:none;
}
form fieldset input[type="submit"] {
background-color: #008dde;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #f4f4f4;
cursor: pointer;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
height: 43px;
text-transform: uppercase;
width: 300px;
-webkit-appearance:none;
}
form fieldset a {
color: #5a5656;
font-size: 10px;
}
form fieldset input[type="submit"]:hover{
	background-color : blue;
}
#signup{
	float: right;
	cursor: pointer;
}
form fieldset a:hover { text-decoration: underline; }
input[type=button]{

    background-color: white;
    border: none;
    color: black;
    padding: 0px 0px;
    text-decoration: none;
    margin: 0px 0px;
    cursor: pointer;
    position: relative;
    left: 10px;
    bottom: 0px;
}
</style>
</head>
<body>

<div id="Submit">
<center><a href="frontpage.html"><img src="login.png" width="330"></a></center>
<form method="POST" action="register.php"  ></p>
<fieldset>
<p><input type="text" id="namebox" name="name" placeholder="Name"  required><input type="text" id="usernamebox" name="username" placeholder="Username"  required>
<input type="password" id="passwordbox" name="password" placeholder="Password"  required><input type="password" id="cpasswordbox" name="cpassword" placeholder="Confirm Password"  required>
<input type="text" id="emailbox" name="email" placeholder="Email-id"  required><input type="text" id="mobilebox" name="mobile" placeholder="Mobile No."  required></p>

<center><p><input type="submit" value="Submit" onClick = "validateEmail();checkbox()"></p></center>
</form>
<script>
function checkbox(){
	var x = document.getElementById('usernamebox').value;
	var y = document.getElementById('passwordbox').value;
	var a = document.getElementById('namebox').value;
	var b = document.getElementById('cpasswordbox').value;
	var c = document.getElementById('emailbox').value;
	var d = document.getElementById('mobilebox').value;
	if(x==""){
		usernamebox.style.backgroundColor = "pink";
	}
	else{
		usernamebox.style.backgroundColor = "lightgrey";
		
	}
	if(y!=""){
		passwordbox.style.backgroundColor = "lightgrey";
	}
	else{
		passwordbox.style.backgroundColor = "pink";
	}
	if(a==""){
		namebox.style.backgroundColor = "pink";
	}
	else{
		namebox.style.backgroundColor = "lightgrey";
		
	}
	if(b==""){
		cpasswordbox.style.backgroundColor = "pink";
	}
	else{
		cpasswordbox.style.backgroundColor = "lightgrey";
		
	}
	if(c==""){
		emailbox.style.backgroundColor = "pink";
	}
	else{
		emailbox.style.backgroundColor = "lightgrey";
		
	}
	if(d==""||isNaN(d)){
		alert("Only numbers allowed, please re-enter");
		mobilebox.style.backgroundColor = "pink";
	}
	else{
		mobilebox.style.backgroundColor = "lightgrey";
		
	}
	function validateEmail()
      {
         var emailID = document.getElementById('emailbox').value;
         atpos = emailID.indexOf("@");
         dotpos = emailID.lastIndexOf(".");
         
         if (atpos < 1 || ( dotpos - atpos < 2 )) 
         {
            alert("Please enter correct email ID")
            emailbox.style.backgroundColor = "pink";
            return false;
         }
         return( true );
      }
}
</script>
</fieldset>
</div>
</body>
</html>