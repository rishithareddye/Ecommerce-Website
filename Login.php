<?php
// Start the session
session_start();
$_SESSION['user'] = "";
$_SESSION['role'] = "";
?>
<?php include 'Database/database.php'; ?>
<?php if(isPostback()==0)
{
	
}
else
{
	login();
	if(isset($_SESSION['role']))
		if($_SESSION['role'] == 'customer')
			redirect('Order_info.php');
		 else if($_SESSION['role'] == 'supplier')
			redirect('product.php');
		else 
			 echo '<script> alert("Invalid user_id or password");</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="Style/style.css">
</head>

<body>


<center>
<div>
<h2><center>Login Page</center></h2>
  <form action="Login.php" method = "post" >

<table>
<tr>
<td><label for="userid" >User_id</label></td>
<td><input type="text" placeholder="User_id" id="userid" name="userid" /></td>
</tr>
<tr>
<td><label for="password" >Password</label></	td>
<td><input type="password" placeholder="Password" id="password" name="password" /></td>
</tr>
<tr>
<td><b>Not a member?</b><label for="registration"></td><td><a href="registration.php">Register here</a></label></td>
</tr>

<tr>
<td colspan="2"><center><input type="submit" name="submit" value="login" ></center></td>
</tr>
</table>  
  </form>
</div>
</center>
</body>
</html>