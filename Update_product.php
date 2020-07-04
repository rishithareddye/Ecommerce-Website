<?php error_reporting(E_ERROR | E_PARSE);?>
<?php include 'Database/database.php'; ?>
<?php include 'Content/nav.php';?>
<?php include 'Content/header.php';?>
<?php 
supplierRediect($_SESSION['user']);
if(isset($_GET['product']))
{
	$result=getCost($_SESSION['user'],$_GET['product']);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$cost = $row['unit_price'];
		$category = $row['category'];
		$units = $row['units'];
		
	}
}

?>
<?php if(isPostback()==0)
{
	
}
else
{
	updateproduct($_SESSION['user'],$_GET['product']);
	echo "<script>alert('Product updated')</script>";
}
?>
<title>Update Product</title>
<center>
<div>
<h2><center>Update Product</center></h2>
  <form action="Update_product.php" method = "post" >

<table>
<tr>
<td><label for="product name" >Product Name</label></td>
<td> <select id="product" name="product" onchange="location.href ='Update_product.php?product='+this.value;">
<option value="0">select</option>
<?php getProducts($_SESSION['user']); ?>

</select></td>
</tr>
<tr>
<td><label for="productcost" >Product Cost</label></td>
<td><input type="text" placeholder="Cost Per unit" id="cost" name="cost" <?php if(isset($cost)) echo "value=$cost"; ?> /></td>
</tr>
<tr>
<td><label for="numberofunits" >No. of Units</label></td>
<td> <input type="text" placeholder="Number of Units" id="units" name="units" <?php if(isset($units)) echo "value=$units"; ?> /><td>
</tr>
<tr>
<td><label for="category" >Category</label></td>
<td> <input type="text" placeholder="Category" id="category" name="category" <?php if(isset($units)) echo "value=$category"; ?> /></td>
</tr>
<tr>
<td colspan="2"><center><input type="submit" name="submit" value="submit" ></center></td>
</tr>
</table>  
  </form>
</div>
</center>
<?php include 'Content/footer.php';?>