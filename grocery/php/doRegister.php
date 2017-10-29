<?php
require 'functions.php';
$name = trim($_POST["name"]);
	$email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
	insertUser($name,$email,$password,'user');
	header("Location:../login.php");

?>