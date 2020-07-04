<?php
// Start the session
session_start();
?>
<ul>
<?php 
$role = $_SESSION['role'];
if($role == "customer")
{
	$result = getCustomer($_SESSION['user']);
	if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$customer = $row['customer_name'];
	}
	echo '<li><a href="">Home</a></li>';
	echo '<li class="dropdown">';
	echo '<a href="javascript:void(0)" class="dropbtn">Orders</a>';
	echo '<div class="dropdown-content" style="width:1%">';
	echo ' <a href="order_info.php">Place Order</a>';
	echo '<a href="update_order.php">Edit Order</a>';
	echo '<a href="viewpage.php">View Orders</a>';
	echo '</div></li>';
	echo '<li style="float:right"><a class="active" href="logout.php">LogOut</a></li>';
	echo '<li style="float:right"><a class="active" href="editcustomer.php">Edit Profile</a></li>';
	echo '<li style="float:right"><a class="active" href="#">Hi! '.$customer.'</a></li>';
}
else if($role == "supplier")
{
	$result = getSupplier($_SESSION['user']);
	if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$supplier = $row['supplier_name'];
	}
	echo '<li><a href="">Home</a></li>';
	echo '<li class="dropdown">';
	echo '<a href="javascript:void(0)" class="dropbtn">Inventory</a>';
	echo '<div class="dropdown-content" style="width:1%">';
	echo ' <a href="product.php">Add Prodct</a>';
	echo '<a href="update_product.php">Update Product</a>';
	echo '<a href="viewproduct.php">View Products</a>';
	echo '</div></li>';
	echo '<li style="float:right"><a class="active" href="logout.php">LogOut</a></li>';
	echo '<li style="float:right"><a class="active" href="editsupplier.php">Edit Profile</a></li>';
	echo '<li style="float:right"><a class="active" href="#">Hi! '.$supplier.'</a></li>';
}
	?>
</ul>
<br/>
<br/>