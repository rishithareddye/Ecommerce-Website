<?php error_reporting(E_ERROR | E_PARSE);?>
<?php include 'Database/database.php'; ?>
<?php include 'Content/nav.php';?>

<?php 
supplierRediect($_SESSION['user']);
$result = getSupplier($_SESSION['user']);
if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
$supplier = $row['supplier_name'];
$email = $row['email'];
$address = $row['address'];
$contact = $row['contact_number'];
}
if(isPostback()==0)
{
	
}
else
{
	updateProfile($_SESSION['user'],$_SESSION['role']);
	$result = getSupplier($_SESSION['user']);
if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
$supplier = $row['supplier_name'];
$email = $row['email'];
$address = $row['address'];
$contact = $row['contact_number'];
}
}
?>
<?php include 'Content/header.php';?>

<title>Edit Profile</title>
<center>
<div>
<h2><center>Edit Supplier Profile Page</center></h2>
  <form action="editsupplier.php" method = "post" >

<table>
<tr>
<td><label for="name" >Name</label></td>
<td><input type="text" placeholder="name" id="name" name="name" value=<?php if(isset($supplier)) echo $supplier ; else echo "name"; ?> /></td>
</tr>
<tr>
<td><label for="email" >Email</label></td>
<td><input type="text" placeholder="email" id="email" name="email" value = <?php if(isset($email)) echo $email ; else echo "mail";?>  /></td>
</tr>
<tr>
<td><label for="address" >Address</label></td>
<td><textarea input type="text" placeholder="address" id="address" name="address" ><?php if(isset($address)) echo $address ; else echo "address";?></textarea></td>
</tr>
<tr>
<td><label for="contactnumber" >Contact No.</label></td>
<td><input type="text" placeholder="contactnumber" id="contactnumber" name="contactnumber" value=<?php if(isset($contact)) echo $contact ; else echo "contact";?>  /></td>
</tr>
<tr>
<td colspan="2"><center><input type="submit" name="submit" value="submit" ></center></td>
</tr>
</table>  
  </form>
</div>
</center>
<?php include 'Content/footer.php';?>