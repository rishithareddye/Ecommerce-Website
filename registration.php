<?php include 'Database/database.php'; ?>
<?php if(isPostback()==0)
{
	
}
else
{
	register();
	alert("registered succesfully");
	redirect('login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="Style/style.css">
</head>
<body>
<script>
function validateForm() {
    var x = document.forms["register"]["email_id"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        return false;
    }
	
}
</script>
<title>Registration</title>
<center>
<div>
<h2><center>Registration Page</center></h2>
  <form action="registration.php" method = "post" name="register" onsubmit="return validateForm();">

<table>
<tr>
<td><label for="name" >User ID<label></td>
<td><input type="text" placeholder="User ID" id="user" name="user" /></td>
</tr>
<tr>
<td><label for="name" >Name</label></td>
<td><input type="text" placeholder="Name" id="name" name="name" /></td>
</tr>
<tr>
<td><label for="name" >Password</label></td>
<td><input type="password" placeholder="Password" id="password" name="password" /></td>
</tr>
<tr>
<td><label for="name" >Retype Password</label></td>
<td><input type="password" placeholder="Retpe Password" id="repassword" name="repassword" /></td>
</tr>
<tr>
<td><label for="email_id" >Email</label></td>
<td><input type="text" placeholder="email_id" id="email_id" name="email_id" /></td>
</tr>
<tr>
<td><label for="contact_number" >Contact No.</label></td>
<td><input type="text" placeholder="Contact Number" id="contact_number" name="contact_number" /></td>
</tr>
<tr>
<td><label for="address" >Address</label></td>
<td><textarea input type="text" placeholder="address" id="address" name="address" /></textarea></td>
</tr>
<tr>
<td><label for="role" >Role</label></td>
<td> <select id="role" name="role">
      <option value="customer">Customer</option>
      <option value="supplier">Supplier</option>
    </select></td>
</tr>

<tr>
<td colspan="2"><center><input type="submit" name="submit" value="Register" /></center></td>
</tr>
</table>  
  </form>
</div>
</center>
</body>
</html>