<?php
 //include "../include/login.php";
session_start();

session_destroy();

redirect("./login.php");
//echo "<script>Window.open('login.php','_self')</script>";
?>
