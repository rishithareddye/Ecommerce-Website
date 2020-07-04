<?php error_reporting(E_ERROR | E_PARSE) ?>
<?php include 'Database/database.php'; ?>
<?php include 'Content/nav.php';?>
<?php include 'Content/header.php';?>

<?php 
supplierRediect($_SESSION['user']);
if(isPostback()==0)
{
	
}
else
{
addproduct($_SESSION['user']);
}
?>
<title>Add Product</title>
<title>Add Product</title>
<center>
<div>
<h2><center>Add Product</center></h2>
  <form action="product.php" method = "post" >

<table>
<tr>
<td><label for="product name" >Product ID</label></td>
<td> <input type="text" placeholder="Product ID" id="id" name="id" /> </td>
</tr>
<tr>
<td><label for="product name" >Product Name</label></td>
<td> <input type="text" placeholder="Product name" id="product" name="product" /> </td>
</tr>
<tr>
<td><label for="productcost" >Product Cost</label></td>
<td><input type="text" placeholder="Cost Per unit" id="cost" name="cost" /></td>
</tr>
<tr>
<td><label for="numberofunits" >No. of Units</label></td>
<td> <input type="text" placeholder="Number of Units" id="units" name="units" /><td>
</tr>
<tr>
<td><label for="category" >Category</label></td>
<td> <input type="text" placeholder="Category" id="category" name="category" /></td>
</tr>
<tr>
<td colspan="2"><center><input type="submit" name="submit" value="submit" ></center></td>
</tr>
</table>  
  </form>
</div>
</center>
<?php include 'Content/footer.php';?>