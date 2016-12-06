<?php
session_start();
require 'connect.inc.php';
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
$hint="";
if($_SESSION['login']==true){
if(isset($_POST['post'])&&!empty($_POST['post'])){
	$uname = $_SESSION['uname'];
	$post = $_POST['post'];
	$post = check_url($post);
	$time = time();
	$query = "INSERT INTO posts (post,user_name_fk,created,likes) VALUES ('$post','$uname','$time',0)";
	$quey_run=mysql_query($query);
	if($quey_run){
		header("Location:home.php");
	}
	else{
		echo $quey_run;
		echo "Some Error Occured";
	}
}
else{
	$hint = "Post is empty";
	header("Location:home.php");
}
}
else{
	header("Location:index.php");
}
?>