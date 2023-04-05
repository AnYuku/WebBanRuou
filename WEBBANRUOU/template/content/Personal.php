<?php

session_start();

if(!isset($_SESSION['logged_in'])){
    header("location: login.php"); 
    exit();
}
echo 'Day la trang dang nhap';

echo '<a href="logout.php">Log out</a>';



?>