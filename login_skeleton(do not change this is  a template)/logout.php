<?php

    // First we execute our common code to connection to the database and start the session
    require("common.php");
    // We remove their data from the session
    unset($_SESSION['user']);
//header("Location: index.php");
  //  die("Redirecting to: index.php");
?>    
    
	
	<!DOCTYPE html>
	<html>
	<head>
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<title>Division by Zero</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<link rel="stylesheet" type="text/css" href="style.css" />
	</head>

	<body>
	<form id="login" action = "index.php" >
	
		<fieldset id="actions">
			<h1 class = "logouth1">Logged Out</h1>
			  
			<input type="submit" id="backtologin" value="HOME" >
			
		</fieldset>
	
		<fieldset id = "links">
			<a class = "glow" href="http://www.divisionbyzero.wozaonline.co.za">Division by Zero Web Development</a>
		</fieldset>
	</form>
	</body>

	</html>
    
    
