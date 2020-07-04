<?php 
session_start();
?>
<?php error_reporting(E_ERROR | E_PARSE);?>
<?php 
session_destroy();
echo "<script>location.href = 'login.php'</script>";
?>