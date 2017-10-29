<?php

$db = mysqli_connect("localhost","Database_user","Database_Password","Database_name");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  if(!isset($_SESSION['cart'])) {
			    $_SESSION['cart'] = array();
			}
?>