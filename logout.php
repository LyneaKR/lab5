<?php 
session_start();
print_r($_SESSION["user"]);
unset($_SESSION["user"]);
header("Location: ./index.php");

?>


