<?php
$error='Could not connect';
$host='localhost';
$user='root';
$pass='123';
$database='sns';
if(!@mysql_connect($host,$user,$pass) || !@mysql_select_db($database))
{
	die ($error);
}
?>