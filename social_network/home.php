<?php
session_start();
if($_SESSION['login']==false)
	header("Location:index.php");
?>
<html>
	<head>
		<title>SNS</title>
		<script type="text/javascript" src="sns.js"></script>
		<style>
html{
    background-color: #f5f5f5;
}

#wrap {
    padding: 25px;
}
textarea {
    border: 1px solid black;
    background-color: #fff;
}
		</style>
	</head>
	<body>
	<div style="width:100%; height:50px; background-color:#980000;">
	<p style="color:violet;">Welcome 
		<?php
		require 'connect.inc.php';
		if(isset($_SESSION['login']) && $_SESSION['login']==true)
		{
			$fname=$_SESSION['fname'];
			$lname = $_SESSION['lname'];
			$gender=$_SESSION['gender'];
			$uname = $_SESSION['uname'];
			echo '<a href="profile.php">'.$fname." ".$lname.'</a>';
			echo '<br>'.$uname.' <a href="signout.php" style="color: pink">Logout</a>';
			
		}
		else
		{
			echo 'GUEST';
		}
		?>
		<a href="home.php">Home</a>
<a href="profile.php">Profile</a>
		</p>
		<div style="position:relative; top:-40px; left:500px;" >
		<input type="text" placeholder="Search Your Friend" onkeyup="showResult(this.value);">
		<div id="livesearch" style="width:200px; background-color:white;"></div>
		</div>
	</div>
	<div style="border:5px solid #980000; height:550px; overflow:scroll;">
		
		<div>
	<form action="posts.php" method="POST">
		<div id="wrap">
    		<textarea class="my-textarea" placeholder="What's up?" rows="5" cols="30" name="post"></textarea>
    		<br>
    		<input class="post" type="submit" value="Post" >
		</div>
	</form>
	<?php
require "connect.inc.php";
$query = "SELECT p.* FROM posts as p JOIN friend as f ON (f.friend1 = p.user_name_fk AND f.friend2 = '$uname' AND f.status='accept') OR (f.friend2 = p.user_name_fk AND f.friend1 = '$uname' AND f.status='accept')";
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
		if($num==0)
		echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="like" id="like'.$id.'" title="Like" rel="Like" onclick="change(this)">Like</a>';
		else
        echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="like" id="like'.$id.'" title="Unlike" rel="Unlike" onclick="change(this)">Unlike</a>';
		echo '<div id="likes'.$id.'">'.$clike.'</div>';
		echo '<a href="profile.php?q='.$_SESSION['uname'].'">'.$first_name." ".$last_name.'</a>'."<br>";
		echo '<input type="textarea" onkeypress="onTestChange(this);" id="cmnt'.$id.'"/>';
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
				echo '<a href="profile.php?q='.$user.'">'.$first." ".$last.'</a>'."<br>".$comment.'<br>';
				$query_cmnt_like = "SELECT * FROM like_cmnt WHERE cmnt_id_fk = '$cid' AND user_name_fk ='$user_name'";
				$query_cmnt_like_run=mysql_query($query_cmnt_like);
				if($query_cmnt_like_run){
				$num1 = mysql_num_rows($query_cmnt_like_run);
				}
				if($num1==0)
		echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="clike" id="clike'.$cid.'" title="Like" rel="Like" onclick="cchange(this)">Like</a>';
		else
        echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="clike" id="clike'.$cid.'" title="Unlike" rel="Unlike" onclick="cchange(this)">Unlike</a>';
		echo '<div id="clikes'.$cid.'">'.$cmnt_like.'</div>';
		//sddsrgffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
				echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none; text-align:right;" onclick="show_reply(this)" id="reply'.$cid.'">Reply '.$reply_count.'</a>';				echo '<div id="show_reply'.$cid.'" style="height:300px; overflow:scroll; display:none;">';
				echo '<input type="textarea" onkeypress="doReply(this);" id="rply'.$cid.'"/>';
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
					echo '<a href="profile.php?q='.$user_r.'">'.$first_r." ".$last_r.'</a>'."<br>".$reply.'<br>';
					$query_reply_like = "SELECT * FROM like_reply WHERE reply_id_fk = '$rid' AND user_name_fk ='$user_name'";
					$query_reply_like_run=mysql_query($query_reply_like);
					if($query_reply_like_run){
						$num2 = mysql_num_rows($query_reply_like_run);
					}
					}
					//echo $rid.' '.$user_name;
					if($num2==0)
						echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="rlike" id="rlike'.$rid.'" title="Like" rel="Like" onclick="ccchange(this)">Like</a>';
					else
						echo '<a onmouseover="change_cursor(this)" onmouseout="back_change(this)" style = "color:blue; text-decoration:none;" class="rlike" id="rlike'.$rid.'" title="Unlike" rel="Unlike" onclick="ccchange(this)">Unlike</a>';
					echo '<div id="rlikes'.$rid.'">'.$r_like.'</div>'.'<hr>';
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
</body>
</html>