<?php
require 'connect.inc.php';
function username_exists($username)
{
	$query = "SELECT user_name FROM users WHERE user_name='$username'";
	$query_run=mysql_query($query);
	$num_row = mysql_num_rows($query_run);
	if($num_row == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}
if(isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['uname'])&&isset($_POST['password'])&&isset($_POST['cpassword'])&&isset($_POST['gender'])&&isset($_POST['email'])&&isset($_POST['place']))
{
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = strtolower($_POST['uname']);
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$place = $_POST['place'];
	if(!empty($fname)&&!empty($lname)&&!empty($uname)&&!empty($password)&&!empty($cpassword)&&!empty($gender)&&!empty($email)&&!empty($place))
	{
		if($password==$cpassword){
			if(username_exists($uname)==false)
			{
				$query = "INSERT INTO users (user_name,fname,lname,password,gender,email,place) VALUES ('$uname','$fname','$lname','$password','$gender','$email','$place')";
				if($query_run=mysql_query($query))
				{
					echo 'Record UPDATED';
				}
				else{
				echo "Some Error Occured";
				}
			}
			else
			{
				echo 'Username Already Exists';
			}
			//echo 'ok';
		}else{
			echo "Password doesn't match";
		}
	}
	else
	{
		echo "ALL Fields Required";
	}
}
else {
	echo "Some Error Occured";
}
?>