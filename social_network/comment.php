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
    $comment = $_GET['cmnt'];
    $comment = check_url($comment);
    require "connect.inc.php";
    $time = time();
    $num1=0;
	$query_run = mysql_query("insert into cmnt (cmnt_val,post_id_fk,user_name_fk,created,reply_count,likes) values ('$comment','$key','$uname','$time',0,0)");
    $sql = "SELECT * FROM cmnt WHERE post_id_fk = $key ORDER BY created DESC";
		$query= mysql_query($sql);
    while($row = mysql_fetch_assoc($query)){
    	$user = $row['user_name_fk'];
		$comment = $row['cmnt_val'];
		$cid = $row['cmnt_id'];
		$reply_count = $row['reply_count'];
		$cmnt_like = $row['likes'];
		$query_cmnt_name = mysql_query("SELECT * FROM users WHERE user_name = '$user'");
		if($query_cmnt_name){
		$first = @mysql_result($query_cmnt_name,0,'fname');
		$last = @mysql_result($query_cmnt_name,0,'lname');
		$val =  $val."".$first." ".$last."<br>".$comment."<br>";
		$query_cmnt_like = "SELECT * FROM like_cmnt WHERE cmnt_id_fk = '$cid' AND user_name_fk_w ='$uname'";
				$query_cmnt_like_run=mysql_query($query_cmnt_like);
				if($query_cmnt_like_run){
				$num1 = mysql_num_rows($query_cmnt_like_run);
				}
				if($num1==0)
		$val=$val.'<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="clike" id="clike'.$cid.'" title="Like" rel="Like" onclick="cchange(this)">Like</a>';
		else
        $val=$val.'<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="clike" id="clike'.$cid.'" title="Unlike" rel="Unlike" onclick="cchange(this)">Unlike</a>';
		$val=$val.'<div id="clikes'.$cid.'">'.$cmnt_like.'</div>';
		$val =$val.'<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none; text-align:right;" onclick="show_reply(this)" id="reply'.$cid.'">Reply '.$reply_count.'</a>';
				$val =$val.'<div id="show_reply'.$cid.'" style="height:300px; overflow:scroll; display:none;">';
				$val =$val.'<input type="textarea" onkeypress="doReply(this);" id="rply'.$cid.'"/>';
				$val =$val.'<div id="replies'.$cid.'" style="background-color:white;">';
				$sql_q = "SELECT * FROM reply WHERE cmnt_id_fk = $cid ORDER BY created DESC";
				$query_reply = mysql_query($sql_q);
				if($query_reply){
				while($row2 =mysql_fetch_assoc($query_reply)){
					$user_r = $row2['user_name_fk'];
					$reply = $row2['reply_val'];
					$query_reply_name = mysql_query("SELECT * FROM users WHERE user_name = '$user_r'");
					if($query_reply_name){
					$first_r = @mysql_result($query_reply_name,0,'fname');
					$last_r = @mysql_result($query_reply_name,0,'lname');
					$val =$val.$first_r." ".$last_r."<br>".$reply.'<hr>';
					}
				}
				$val = $val.'</div>';
				$val = $val.'</div>';
				$val = $val."<hr>";
		}
	}
   }
    echo $val;
?>