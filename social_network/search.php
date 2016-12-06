<?php
if(isset($_GET["q"])){
$key = $_GET["q"];
}
else{
$key = "a";
}
require 'connect.inc.php';
$sql = sprintf("SELECT * FROM users WHERE fname LIKE '%s%%'",
               mysql_real_escape_string($key));
$query = mysql_query($sql);
while($row = mysql_fetch_assoc($query)){
    echo $row['fname'];
}
?>