<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php include 'Database/database.php'; ?>
<?php include 'Content/nav.php';?><?php include 'Content/header.php';?>

<?php 
customerRediect($_SESSION['user']);
if(isset($_GET['update']))
{
	
	$result = getOrderInfo($_GET['update']);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$id = $row['product_id'];
		$name = getProductName($id);
		$_SESSION['order'] = $_GET['update'];
		$_SESSION['units'] = $row['units'];
		$order = $row['order_id'];
		$date = $row['required_date'];
		$units = $row['units'];
		$cost = $row ['cost'];
		$costs = floatval($cost)/floatval($units); 
	}

}


?>
<?php if(isPostback()==0)
{
	
}
else
{
	updateOrder($_SESSION['user'],$_SESSION['order']);
	if($_SESSION['units'] != $_POST['units'])
		updateProductCount($_POST['units'],$_POST['product']);
}
?>
<title>Update Orders</title>
<center>
<div>
<h2><center>Update_order</center></h2>
  <form action="update_order.php" method = "post" >

<table>
<tr>
<td><label for="order" >Order ID</label></td>
<td> <select id="order" name="order" onchange="location.href ='update_order.php?update='+this.value;" >
<option value="0">select</option>

<?php getOrders($_SESSION['user']); ?>
    </select></td>
</tr>
<tr>
<td><label for="product" >Product Id</label></td>
<td><input type="text" id="product" name="product" readonly=true <?php if(isset($id)) echo "value=$id"; ?> /></td>
</tr>
<tr>
<td><label for="product" >Product Name</label></td>
<td><input type="text" id="productname" name="productname" readonly=true <?php if(isset($name)) echo "value=$name"; ?> /></td>
</tr>
<tr>
<td><label for="productcost" >Product Cost</label></td>
<td><input type="text" id="productcost" name="productcost" readonly=true <?php if(isset($costs)) echo "value=$costs"; ?> /></td>
</tr>
<tr>
<td><label for="units" >No. of Units</label></td>
<td> <select id="units" name="units" onchange="myFunction()" >
<option value='0'>select</option>
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
<td><input type="date" placeholder="required date" id="requireddate" name="requireddate" <?php if(isset($date)) echo "value=$date"; ?> /></td>
</tr>
<tr>
<td colspan="2"><center><input type="submit" name="submit" value="submit" ></center></td>
</tr>
</table>  
  </form>
</div>
</center>
<?php include 'Content/footer.php';?>