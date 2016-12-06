<?php
	session_start();
	$f1 = $_SESSION['uname'];
	$f2 = $_GET['q'];
	$action=$_GET['action'];
	$value = $_GET['value'];
	require "connect.inc.php";
	if($action=="add"){
		$time = time();
		$query = "insert into Friend (friend1,friend2,status,time) values ('$f1','$f2','waiting','$time')";
		if($query_run=mysql_query($query)){
			echo "Cancel Request";
		}
		else{
			echo "Add Friend";
		}
	}
	else if($action=="cancel"){
		$query = "delete from Friend where (friend1 = '$f1' or friend1 = '$f2') and (friend2 = '$f1' or friend2 = '$f2')";
		
		if($query_run=mysql_query($query)){
			echo "Add Friend";
		}
		else{
			echo $value;
		}
	}
	else{
		$time = time();
		$query = "update Friend set status='accept' , time='$time' where friend1='$f2' and friend2='$f1'";
		if($query_run=mysql_query($query)){
			echo "Unfriend";
		}
		else{
			echo "Confirm Friend";
		}
	}
?>