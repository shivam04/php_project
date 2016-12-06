<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login']==true)
		{
			header('Location: home.php');
		}
?>
<html>
<head>
<title>SNS</title>
<link rel="stylesheet" type="text/css" href="login.css"> 
</head>
<body>
<div id="head">
<h1><center>SNS</center></h1>
</div>
<div id="main">
<div id="inner_main">
	<h1> Error 404 page not found</h1>
</div>
</div>
<div id="foot">
</div>
</body>
</html>