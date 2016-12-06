<?php
session_start();
function check_url($value)
{
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	if(preg_match($reg_exUrl, $value, $url)) {

       // make the urls hyper links
       return (preg_replace($reg_exUrl, '<a href='.$url[0].' target="_blank">'.$url[0].'</a> ', $value));

} else {

       // if no urls in the text just return the text
       return ($value);

}
}
	$val="";
	$uname = $_SESSION['uname'];
    $key=$_GET['q'];
    $reply = $_GET['reply'];
    $reply = check_url($reply);
    require "connect.inc.php";
    $time = time();
    $cmt_reply_cnt_update = mysql_query("update cmnt set reply_count=reply_count+1 where cmnt_id = $key");
    $rty = "insert into reply (reply_val,cmnt_id_fk,user_name_fk,r_like,created) values ('$reply','$key','$uname',0,'$time')";
	$query_run = mysql_query($rty);
	if($query_run){
    $sql = "SELECT * FROM reply WHERE cmnt_id_fk = $key ORDER BY created DESC";
		$query= mysql_query($sql);
    while($row = mysql_fetch_assoc($query)){
    	$user = $row['user_name_fk_r'];
		$reply = $row['reply_val'];
		$query_reply_name = mysql_query("SELECT * FROM users WHERE user_name = '$user'");
		if($query_reply_name){
		$first = @mysql_result($query_reply_name,0,'fname');
		$last = @mysql_result($query_reply_name,0,'lname');
		$val =  $val."".$first." ".$last."<br>".$reply."<hr>";
		}
		else{
			echo "unable to print";
		}
    }
    echo $val;
}
else{
	echo "shit";
}
?>