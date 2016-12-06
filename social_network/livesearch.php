<?php
	require "connect.inc.php";
    $key=$_GET['q'];
    $array = "";
    $query=mysql_query("select * from users where user_name LIKE '%{$key}%'");
    while($row=mysql_fetch_assoc($query))
    {
      if($array==""){
		$array = "<a href='#' target='_blank'>".$row['fname'].$row['lname']."</a>"  ;
	  }
	  else{
		$array = $array."<br \>"."<a href='profile.php?q=$row[user_name]' target='_blank'>".$row['fname'].$row['lname']."</a>" ;  
	  }
    }
    $query=mysql_query("select * from users where fname LIKE '%{$key}%'");
    while($row=mysql_fetch_assoc($query))
    {
      if($array==""){
		$array = "<a href='profile.php?q=$row[user_name]' target='_blank'>".$row['fname'].$row['lname']."</a>"  ;
	  }
	  else{
		$array = $array."<br \>"."<a href='profile.php?q=$row[user_name]' target='_blank'>".$row['fname'].$row['lname']."</a>" ;  
	  }
    }
    echo $array;
?>