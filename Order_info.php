<?php error_reporting(E_ERROR | E_PARSE);?>
<?php include 'Database/database.php'; ?>
<?php include 'Content/nav.php';?><?php include 'Content/header.php';?>

<?php 
customerRediect($_SESSION['user']);
if(isset($_GET['product']))
{
	$result=getCosts($_GET['product']);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$cost = $row['unit_price'];
		$product = $_GET['product'];
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
	addOrder($_SESSION['user']);
	updateProductCount($_POST['units'],$product,$units);
}
?>
<title>Add Order</title>
<center>
<div>
<h2><center>Order_info</center></h2>
  <form action="Order_info.php" method = "post" >

<table>
<tr>
<td><label for="product name" >Product Name</label></td>
<td> <select id="product" name="product" onchange="location.href ='Order_info.php?product='+this.value;" >
<option value="0">select</option>
<?php getProduct(); ?>
    </select></td>
</tr>
<tr>
<td><label for="productcost" >Product Cost</label></td>
<td><input type="text" id="productcost" name="productcost" readonly=true <?php if(isset($cost)) echo "value=$cost"; ?> /></td>
</tr>
<tr>
<td><label for="numberofunits" >No. of Units</label></td>
<td> <select id="units" name="units" onchange="myFunction()" >
<?php 
for ($i = 1; $i <= $units; $i++) {
    echo "<option value=".$i." 	>".$i."</option>";
}

?>
    </select></td>
	<script>
function myFunction() {
    var x = parseInt(document.getElementById("units").value);
	var y = parseInt(document.getElementById("productcost").value);
    document.getElementById("totalcost").value = x*y;
}
</script>
</tr>
<tr>
<td><label for="totalcost" >Total Cost</label></td>
<td><input type="text" id="totalcost" name="totalcost" readonly=true /></td>
</tr>
<tr>
<td><label for="requireddate" >Required Date</label></td>
<td><input type="date" placeholder="required date" id="requireddate" name="requireddate" /></td>
</tr>
<tr>
<td colspan="2"><center><input type="submit" name="submit" value="submit" ></center></td>
</tr>
</table>  
  </form>
</div>
</center>
<?php include 'Content/footer.php';?>