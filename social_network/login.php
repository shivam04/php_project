<?php
session_start();
require 'connect.inc.php';
if(isset($_POST['uname']) && isset($_POST['password']) && !empty($_POST['uname']) && !empty($_POST['password']))
{
	$uname= strtolower($_POST['uname']);
	$password = $_POST['password'];
	//$uname_escaped = htmlspecialchars(mysql_real_escape_string($uname));
	$query = "SELECT fname, lname,gender FROM users WHERE user_name ='$uname' AND password='$password'";
	$query_run = mysql_query($query);
	if(mysql_num_rows($query_run)==1)
	{
		$fname=mysql_result($query_run,0,'fname');
		$lname=mysql_result($query_run,0,'lname');
		$gender=mysql_result($query_run,0,'gender');
		$_SESSION['fname']=$fname;
		$_SESSION['login']=true;
		$_SESSION['lname']=$lname;
		$_SESSION['gender']=$gender;
		$_SESSION['uname']=$uname;
		header('Location: home.php');
	}
	else
	{
		die ('Incorrect Username or Password !!');
	}
} 
else{
	echo '<a href="index.php">Login Again</a>';
	die('Could Not Connect');
}
?>