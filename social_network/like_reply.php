<?php
	session_start();
	$uname = $_SESSION['uname'];
    $key=$_GET['q'];
    $action = $_GET['action'];
    require "connect.inc.php";
    if($action=="like"){
    $query_run = mysql_query("update reply set r_like = r_like+1 where reply_id = $key");
    $query=mysql_query("select r_like from reply where reply_id = $key");
    $time = time();
    $query_check = mysql_query("insert into like_reply (reply_id_fk , user_name_fk , created) values ('$key','$uname',$time)");
    while($row = mysql_fetch_assoc($query)){
    	echo $row['r_like'];
    }
}
else{
	$query_run = mysql_query("update reply set r_like = r_like-1 where reply_id = $key");
    $query=mysql_query("select r_like from reply where reply_id = $key");
    $query_check = mysql_query("DELETE FROM like_reply WHERE reply_id_fk = '$key' AND user_name_fk = '$uname'");
    while($row = mysql_fetch_assoc($query)){
    	echo $row['r_like'];
    }
}
?>