<?php
require "connect.inc.php";
session_start();
if(isset($_GET["q"])){
$user_name = $_GET["q"];
if(isset($_SESSION['login']) && $_SESSION['login']==true)
	{
			$fir_n = $_SESSION['fname']; 
			$las_n = $_SESSION['lname'];
			$u_n = $_SESSION['uname'];
			$login="true";
	}
	else{
		$fir_n = "Hello";
		$las_n = "Guest";
		$u_n=" ";
		$login="false";
	}
	$ff = 0;
}
else{
	if(isset($_SESSION['login']) && $_SESSION['login']==true)
	{
			$fir_n = $_SESSION['fname']; 
			$las_n = $_SESSION['lname'];
			$u_n = $_SESSION['uname'];
			$user_name = $_SESSION['uname'];
			$login="true";
	}
	else{
		header('Location: index.php');
	}
	$ff = 1;
}
$query33 = "SELECT * FROM users WHERE user_name='$user_name'";
$query_run33 = mysql_query($query33);
if($query_run33){
	while($row3=mysql_fetch_assoc($query_run33)){
		$fname=$row3['fname'];
		$lname=$row3['lname'];
		$gender=$row3['gender'];
		$place = $row3['place'];
		$pic = $row3['pic'];
		$password=$row3['password'];
	}
}
?>
<html>
<head>
<title><?php echo $fname.' '.$lname ?></title>
<link rel="stylesheet" type="text/css" href="login.css"> 
<script type="text/javascript" src="sns.js"></script>
</head>
<body>
<div id="head" style="float:left">
<?php 
	echo "Welcome ".'<a href="profile.php">'.$fir_n." ".$las_n.'</a>';
	if($u_n!=" ") 
	echo '<br>'.$u_n.' <a href="signout.php" style="color: pink">Logout</a>';
?>
<br><br>
<a href="home.php">Home</a>
<a href="profile.php">Profile</a>
</div>
<div id="main">
	<div style="border: 2px solid black; width:200px; height:300px;">
		<?php echo '<img src="dp/'.$pic.'"  style="height:150px; width:200px;">'; ?><hr>
		<h4 ><?php echo $fname.' '.$lname ?></h4>
	</div>
	<div style="border:2px solid black; width:200px; height:110px;">
		<?php
			if($ff==0){
				if($login=="true"){
					$f1=$u_n;
					$f2=$user_name;
					if($f1!=$f2){
						$query_run_check = mysql_query("select * from Friend where (friend1 = '$f1' or friend1='$f2') and (friend2 = '$f1' or friend2='$f2')");
						$num_row = mysql_num_rows($query_run_check);
						//echo $num_row;
						if($num_row>0){
							$row_fr = mysql_fetch_array($query_run_check);
							if($row_fr['friend1']==$f1){
								if($row_fr['status']=='waiting'){
									echo '<input type="button" value="Cancel Request" id="friend'.$f2.'"  class="friend'.$f2.'" onClick="friendRequestSend(this)"/>';
								}
								else if($row_fr['status']=='accept'){
									echo '<input type="button" value="Unfriend" id="friend'.$f2.'" class="friend'.$f2.'" onClick="friendRequestSend(this)"/>';
								}
							}

							else{
								if($row_fr['status']=='waiting'){
									echo '<input type="button" value="Confirm Request" id="friend'.$f2.'" class="friend'.$f2.'" onClick="friendRequestSend(this)"/>';
									echo '<input type="button" value="Delete Request" id="friend'.$f2.'" class="friend'.$f2.'" onClick="friendRequestSend(this)"/>';
								}
								else if($row_fr['status']=='accept'){
									echo '<input type="button" value="Unfriend" id="friend'.$f2.'" class="friend'.$f2.'" onClick="friendRequestSend(this)"/>';
								}
							}
						}
						else if($num_row==0){
							echo '<input type="button" value="Add Friend" id="friend'.$f2.'" class="friend'.$f2.'" onClick="friendRequestSend(this)"/>';
						}
					}
				}
			}
		?>
		<h4>Gender : <?php echo $gender ?></h4>
		<h4>Place : <?php echo $place ?></h4>
	</div>
	<div style="border:2px solid black; position:relative; top:-322px; left:205px; width:1120px; overflow:scroll; height:322px;">
		<?php
require "connect.inc.php";
$query = "SELECT * FROM posts WHERE user_name_fk = '$user_name' ORDER BY created DESC";
if($query_run=mysql_query($query)){
	while($row=mysql_fetch_assoc($query_run)){
		echo "<div style='background-color: yellow ;width:30%; margin:10px;'>";
		echo '<a href="profile.php?q='.$row['user_name_fk'].'">'.$row['user_name_fk'].'</a>'."<br>".$row["post"];
		$id=$row['post_id'];
		$clike=$row['likes'];
		$num = 0;
		$num1 = 0;
		$num2=0;
		$user_name = $_SESSION['uname'];
		$query_check = "SELECT * FROM like_post WHERE post_id_fk = '$id' AND user_name_fk ='$user_name'";
		$query_check_run=mysql_query($query_check);
		if($query_check_run){
			$num = mysql_num_rows($query_check_run);
		}
		//echo $num;
		$first_name=$_SESSION['fname'];
		$last_name = $_SESSION['lname'];
		echo '<br>';
		if($login=="true"){
			if($num==0)
			echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="like" id="like'.$id.'" title="Like" rel="Like" onclick="change(this)">Like</a>';
			else
	        echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="like" id="like'.$id.'" title="Unlike" rel="Unlike" onclick="change(this)">Unlike</a>';
			echo '<div id="likes'.$id.'">'.$clike.'</div>';
			echo $first_name." ".$last_name."<br>";
			echo '<input type="textarea" onkeypress="onTestChange(this);" id="cmnt'.$id.'"/>';
		}
		else{
			echo '<div id="likes'.$id.'">Likes: '.$clike.'</div>';
		}
		echo '<div id="cmnts'.$id.'" style="background-color: orange ; ">';
		$sql = "SELECT * FROM cmnt WHERE post_id_fk = $id ORDER BY created DESC";
		$query_cmnt = mysql_query($sql);
		if($query_cmnt){
			while($row1 =mysql_fetch_assoc($query_cmnt)){
				$cid = $row1['cmnt_id'];
				$user = $row1['user_name_fk'];
				$comment = $row1['cmnt_val'];
				$reply_count = $row1['reply_count'];
				$cmnt_like = $row1['likes'];
				$query_cmnt_name = mysql_query("SELECT * FROM users WHERE user_name = '$user'");
				if($query_cmnt_name){
				$first = @mysql_result($query_cmnt_name,0,'fname');
				$last = @mysql_result($query_cmnt_name,0,'lname');
				echo $first." ".$last."<br>".$comment.'<br>';
				$query_cmnt_like = "SELECT * FROM like_cmnt WHERE cmnt_id_fk = '$cid' AND user_name_fk ='$user_name'";
				$query_cmnt_like_run=mysql_query($query_cmnt_like);
				if($query_cmnt_like_run){
				$num1 = mysql_num_rows($query_cmnt_like_run);
				}
				if($login=="true"){
				if($num1==0)
		echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="clike" id="clike'.$cid.'" title="Like" rel="Like" onclick="cchange(this)">Like</a>';
		else
        echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="clike" id="clike'.$cid.'" title="Unlike" rel="Unlike" onclick="cchange(this)">Unlike</a>';
		echo '<div id="clikes'.$cid.'">'.$cmnt_like.'</div>';
	}
	else{
		echo '<div id="clikes'.$cid.'">Likes: '.$cmnt_like.'</div>';
	}
		//sddsrgffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
				echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none; text-align:right;" onclick="show_reply(this)" id="reply'.$cid.'">Reply '.$reply_count.'</a>';				echo '<div id="show_reply'.$cid.'" style="height:300px; overflow:scroll; display:none;">';
				if($login=="true"){ echo '<input type="textarea" onkeypress="doReply(this);" id="rply'.$cid.'"/>';}
				echo '<div id="replies'.$cid.'" style="background-color:white;">';
				$sql_q = "SELECT * FROM reply WHERE cmnt_id_fk = $cid ORDER BY created DESC";
				$query_reply = mysql_query($sql_q);
				if($query_reply){
				while($row2 =mysql_fetch_assoc($query_reply)){
					$user_r = $row2['user_name_fk'];
					$reply = $row2['reply_val'];
					$r_like = $row2['r_like'];
					$rid=$row2['reply_id'];
					$query_reply_name = mysql_query("SELECT * FROM users WHERE user_name = '$user_r'");
					if($query_reply_name){
					$first_r = mysql_result($query_reply_name,0,'fname');
					$last_r = mysql_result($query_reply_name,0,'lname');
					echo $first_r." ".$last_r."<br>".$reply.'<br>';
					$query_reply_like = "SELECT * FROM like_reply WHERE reply_id_fk = '$rid' AND user_name_fk ='$user_name'";
					$query_reply_like_run=mysql_query($query_reply_like);
					if($query_reply_like_run){
						$num2 = mysql_num_rows($query_reply_like_run);
					}
					}
					if($login=="true"){
					if($num2==0)
						echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="rlike" id="rlike'.$rid.'" title="Like" rel="Like" onclick="ccchange(this)">Like</a>';
					else
						echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="rlike" id="rlike'.$rid.'" title="Unlike" rel="Unlike" onclick="ccchange(this)">Unlike</a>';
					
						echo '<div id="rlikes'.$rid.'">'.$r_like.'</div>'.'<hr>';
					}
					else{
						echo '<div id="rlikes'.$rid.'">Likes: '.$r_like.'</div>'.'<hr>';
					}
				}
			}
				echo '</div>';
				echo '</div>';
				echo "<hr>";
				}
			}
		}
		else{
			echo "error loading comment";
		}
		echo '</div>';
		echo "</div>";
		//echo ""."<hr>";
	}
}
else{
	echo "error";
}
?>
	</div>
</div>
<div id="foot">
</div>
</body>
</html>