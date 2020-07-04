<?php error_reporting(E_ERROR | E_PARSE);?>
<?php include 'Database/database.php'; ?>
<?php include 'Content/nav.php';?><?php include 'Content/header.php';?>

<?php 
customerRediect($_SESSION['user']);
?>
<title>View Orders</title>
<center>
<div style = "width: 6	0%;">
<h2><center>View Page</center></h2>
  <form action="viewpage.php" method = "post" >
<?php printOrder($_SESSION['user']);?>
  </form>
</div>
</center>
<?php include 'Content/footer.php';?>