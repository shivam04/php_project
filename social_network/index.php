<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login']==true)
		{
			header('Location: home.php');
		}
?>
<html>
<head>
<title>IIITM CONNECT</title>
<link rel="stylesheet" type="text/css" href="login.css"> 
</head>
<body>
<div id="head">
<h1><center>IIITM CONNECT</center></h1>
</div>
<div id="main">
<div id="inner_main">
	<h3><center>Login</center></h3>
	<form action="login.php" method="POST">
	<table class="one">
	<tr>
	<td>Username:<input type="text" placeholder="user name" name="uname"></td>
	</tr>
	</table>
	<br>
	<table class="one">
	<tr>
	<td>Password:<input type="password" placeholder="**********" name="password"></td>
	</tr>
	</table>
	<br>
	<center><input type="submit" value="Log In"/></center>
	</form>
	<br>
	<a href="#">Forgot Password</a>
	<a href="register.php" style="float:right;">Not Yet Registered!</a>
</div>
</div>
<div id="foot">
</div>
</body>
</html>