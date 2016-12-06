<?php 
include('db.php');
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$status=$_POST['status'];
$sql=mysql_query("select facebook_id,facebook_access_token from users where username=daringshivamsinah04");
$row=mysql_fetch_array($sql);
$facebook_id=$row['facebook_id'];
$facebook_access_token=$row['facebook_access_token'];
//Facebook Wall Update
$params = array('access_token'=>$facebook_access_token, 'message'=>$status);
$url = "https://graph.facebook.com/$facebook_id/feed";
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_POSTFIELDS => $params,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_VERBOSE => true
));
$result = curl_exec($ch);
// End
}
?>
//HTML
<form method="post" action="">
<textarea name="status"></textarea>
<input type="submit" value=" Update "/>
</form&gt;