<html>
<head>
</head>
<body>
<form action="reg.php" method="POST">
<center><table>
<tr width="100" height="60">
<td width="250">First Name:<br><input type="text" placeholder="first name" name="fname"></td>
<br><br>
<td>Last Name:<br><input type="text" placeholder="last name" name="lname"></td>
</tr>
<tr width="100" height="60">
<td>Username:<br><input type="text" name="uname"></td>
<td>Email:<br><input type="text" name="email"></input></td>
<br><br>
</tr>
<tr width="100" height="60">
<td>Place:<br><input type="text" name="place"></td>
</tr>
<tr width="100" height="60">
<td>Password:<br><input type="password" placeholder="**********" name="password"></td>
<br><br>
<td>Confirm Password:<br><input type="password" placeholder="**********" name="cpassword"></td>
</tr>
</table>
<h4> Select Gender</h4>
<select name="gender">
	<option value="Male">Male</option>
	<option value="Female">Female</option>
</select>
</center>
<br>
<br>
<center><input type="submit" value="Register" name="register"></center>
</form>
</body>
</html>