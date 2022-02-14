<?php
session_start();

if(isset($_SESSION['TIN'])){
    unset($_SESSION['TIN']);
}


header("location: login.php");
die;