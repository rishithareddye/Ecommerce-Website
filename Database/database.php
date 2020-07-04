<?php 
error_reporting(E_ERROR | E_PARSE);
function connect()
{
	try {
	//if(empty($_POST) && !isset($_POST["username"]))
    //{
    //    return null;
    //}
	//else
	{
$servername = "localhost";
$username = "user";
$password = "12345";
$database = "ecommerce";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
	return null;
	}
	return $conn;
	}
}
catch(Exception $e) {
	return null;
}
}
function disconnect($conn)
{
	try{
	if(is_null($conn))
		return false;
	else{
		mysqli_close($conn);
		return true;
	}
	}
	catch(Exception $e) {
	return false;
}
}
function insert($sql)
{
	
	$conn = connect();
	if($conn != null)
	{
	if (mysqli_query($conn, $sql))
	{
		disconnect($conn);
    return true;
	}
else {
	disconnect($conn);
    return false;
}
}
}
function update($sql)
{
	$conn = connect();
	if($conn != null)
	{
	if (mysqli_query($conn, $sql))
	{
		disconnect($conn);
    return true;
	}
else {
	disconnect($conn);
    return false;
}
}
}
function select($conn,$query)
{
	$result = mysqli_query($conn, $query);
	return $result;
}
function customerRediect($role)
{
	if($role == 'customer')
		echo "<script>location.href = 'login.php'</script>";
}
function supplierRediect($role)
{
	if($role == 'supplier')
		echo "<script>location.href = 'login.php'</script>";
}
function alert($msg)
{
	echo '<script>alert($msg)</script>';
}
function redirect($page)
{
		echo "<script>location.href = '$page'</script>";
}
function isPostback()
{
	if (!isset($_POST['submit'])) {
    return 0;
}
	else
	{
		return 1;
	}
}
function register()
{
	$user = $_POST['user'];
	$name = $_POST['name'];
	$email =$_POST['email_id'];
	$contact = $_POST['contact_number'];
	$address = $_POST['address'];
	$role =$_POST['role'];
	$password = $_POST['password'];
	$query = "insert into login values ('$user','$password','$role');";
	$query1 = "insert into $role values ('$name','$user','$email','$address',$contact);";
	insert($query1);
	insert($query);
}
function login()
{
	$conn = connect();
	if($conn !=null)
	{
		$id = $_POST['userid'];
		$password = $_POST['password'];
		$query = "select role from login where user_id='$id' and password = '$password';";
		$result = select($conn,$query);
		$role ="";
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$role = $row['role'];
			}
			$_SESSION['role'] = $role;
			$_SESSION['user'] = $id;
		}
		
		
	}
}
function addproduct($user)
{
	$id = $_POST['id'];
	$product = $_POST['product'];
	$cost = $_POST['cost'];
	$units = $_POST['units'];
	$category = $_POST['category'];
	$query = "insert into product values ('$id','$product','$user',$units,$cost,'$category');";
	//echo $query;
	insert($query);
}
function getProducts($user)
{
	
	$conn = connect();
	if($conn !=null)
	{
		
		$query = "select product_id,product_name from product where supplier_id='$user';";
		$result = select($conn,$query);
		if (mysqli_num_rows($result) > 0) {
    // output data of each row
	
    while($row = mysqli_fetch_assoc($result)) {
		if(isset($_GET['product']) && $_GET['product'] == $row['product_id'])
		echo "<option value=".$row['product_id']." selected>".$row['product_name']."</option>";
	else
		echo "<option value=".$row['product_id']." >".$row['product_name']."</option>";
	}
		disconnect($conn);
	}
	}
}
function getProduct()
{
	
	$conn = connect();
	if($conn !=null)
	{
		
		$query = "select product_id,product_name from product;";
		$result = select($conn,$query);
		if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		if(isset($_GET['product']) && $_GET['product'] == $row['product_id'])
		echo "<option value=".$row['product_id']." selected>".$row['product_name']."</option>";
	else
		echo "<option value=".$row['product_id']." >".$row['product_name']."</option>";
	}
		disconnect($conn);
	}
	}
}
function updateproduct($user,$id)
{
	$product = $_POST['product'];
	$cost = $_POST['cost'];
	$units = $_POST['units'];
	$category = $_POST['category'];
	$query ="update product set units = $units, unit_price = $cost,category = '$category' where product_id = '$product' and supplier_id = '$user';";
	//echo $query;
	update($query);
}
function updateProfile($user,$role)
{
	$name =$_POST['name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$contact =$_POST['contactnumber'];
	$name=$role."_name";
	$id = $role."_id";
	$query = "update $role set $name = '$name', email = '$email' , address = '$address' , contact_number = $contact where $id = '$user';";
	//echo $query;
	update($query);
}
function addOrder($user)
{
	$product = $_POST['product'];
	$cost =$_POST['productcost'];
	$units = $_POST['units'];
	$cost = $_POST['totalcost'];
	$date = $_POST['requireddate'];
	$today = date('d/m/Y');
	$query = "insert into order_info values(NULL,'$user','$product','$today','$date',$units,$cost);";
	//echo $query;
	insert($query);
}
function updateOrder($user,$id)
{
	$product = $_POST['product'];
	$cost =$_POST['productcost'];
	$units = $_POST['units'];
	$cost = $_POST['totalcost'];
	$date = $_POST['requireddate'];
	$today = date('d/m/Y');
	$query = "update order_info set order_date='$today' , required_date = '$date' , units = '$units' , cost = '$cost' where order_id='$id' and customer_id = '$user';";
	//echo $query;
	update($query);
}
function getSupplier($user)
{
	$conn = connect();
	if($conn !=null)
	{
		
		$query = "select * from supplier where supplier_id = '$user' ;";
		$result = select($conn,$query);
		disconnect($conn);
		return $result;
	}
}
function getCost($user,$product)
{
$conn = connect();
	if($conn !=null)
	{
	$query = "select * from product where supplier_id = '$user' and product_id = '$product' ;";
		$result = select($conn,$query);
		disconnect($conn);
		return $result;
	}
}
function getCosts($product)
{
$conn = connect();
	if($conn !=null)
	{
	$query = "select * from product where product_id = '$product' ;";
		$result = select($conn,$query);
		disconnect($conn);
		return $result;
	}
}
function getCustomer($user)
{
	$conn = connect();
	if($conn !=null)
	{
		$query = "select * from customer where customer_id = '$user' ;";
		//echo $query;
		$result = select($conn,$query);
		disconnect($conn);
		return $result;
	}
}
function getOrders($user)
{
$conn = connect();
if($conn !=null)
	{
		$query = "select order_id from order_info where customer_id ='$user';";
		$result = select($conn,$query);
		disconnect($conn);
		if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
					if(isset($_GET['update']) && $_GET['update'] == $row['order_id'])
						echo "<option value=".$row['order_id']." selected>".$row['order_id']."</option>";
					else
						echo "<option value=".$row['order_id']." >".$row['order_id']."</option>";
				}
		}
	}
}
function getOrderInfo($order)
{
	$conn = connect();
if($conn !=null)
	{
		$query = "select * from order_info where order_id ='$order';";
		//echo $query;
		$result = select($conn,$query);
		return $result;
	}
}
function getUnits($id)
{
	$conn = connect();
if($conn !=null)
{
	$query = "select * from product where product_id ='$id';";
	//echo $query;
	$result = select($conn,$query);
	if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
					return $row['units'];
				}
	}
}
}
function updateProductCount($units, $id)
{
	$unit = getUnits($id);
	$change = intval($unit)-intval($units);
	$query = "update product set units = $change where product_id = '$id'";
	//echo $query;
update($query);
}
function printProduct($user)
{
	$conn = connect();
	if($conn !=null)
	{
	$query = "select * from product where supplier_id = '$user' ;";
		$result = select($conn,$query);
		echo"<table><tr><th>Product Id</th><th>Product Name</th><th>Number of Units</th><th>Unit Price</th><th>Edit</th></tr>";
		disconnect($conn);
		if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
					echo '<tr><td>'.$row['product_id'].'</td><td>'.$row['product_name'].'</td><td>'.$row['units'].'</td><td>'.$row['unit_price'].'</td><td><a href=Update_product.php?product='.$row['product_id'].'>EDIT</a></td></tr>';
				}
	}
	}
}
function getProductName($id)
{
	$conn = connect();
if($conn !=null)
{
	$query = "select * from product where product_id ='$id';";
	//echo $query;
	$result = select($conn,$query);
	if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
					return $row['product_name'];
				}
	}
}
}
function printOrder($user)
{
	$conn = connect();
	if($conn !=null)
	{
	$query = "select * from order_info where customer_id = '$user' ;";
		$result = select($conn,$query);
		echo"<table><tr><th>Order Id</th><th>Product Id</th><th>Product Name</th><th>Order Date</th><th>Required Date</th><th>Total Cost</th><th>Edit</th></tr>";
		disconnect($conn);
		if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
					echo '<tr><td>'.$row['order_id'].'</td><td>'.$row['product_id'].'</td><td>'.getProductName($row['product_id']).'</td><td>'.$row['order_date'].'</td><td>'.$row['required_date'].'</td><td>'.$row['cost'].'</td><td><a href=update_order.php?update='.$row['order_id'].'>EDIT</a></td></tr>';
				}
	}
	}
}
?>