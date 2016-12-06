<?php
	session_start();
	$uname = $_SESSION['uname'];
    $key=$_GET['q'];
    $action = $_GET['action'];
    require "connect.inc.php";
    if($action=="like"){
    $query_run = mysql_query("update cmnt set likes = likes+1 where cmnt_id = $key");
    $query=mysql_query("select likes from cmnt where cmnt_id = $key");
    $time = time();
    $query_check = mysql_query("insert into like_cmnt (cmnt_id_fk , user_name_fk , created) values ('$key','$uname',$time)");
    while($row = mysql_fetch_assoc($query)){
    	echo $row['likes'];
    }
}
else{
	$query_run = mysql_query("update cmnt set likes = likes-1 where cmnt_id = $key");
    $query=mysql_query("select likes from cmnt where cmnt_id = $key");
    $query_check = mysql_query("DELETE FROM like_cmnt WHERE cmnt_id_fk = '$key' AND user_name_fk_w = '$uname'");
    while($row = mysql_fetch_assoc($query)){
    	echo $row['likes'];
    }
}
?>