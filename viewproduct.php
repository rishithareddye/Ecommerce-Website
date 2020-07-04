<?php error_reporting(E_ERROR | E_PARSE);?>

<?php include 'Database/database.php'; ?>
<?php include 'Content/nav.php';?>
<?php include 'Content/header.php';?>
<?php 
supplierRediect($_SESSION['user']);
?>
<title>View Products</title>
<center>
<div>
<h2><center>View Products</center></h2>
  <form action="viewproduct.php" method = "post" >
<?php printProduct($_SESSION['user']);?>
  </form>
</div>
</center>
<?php include 'Content/footer.php';?>