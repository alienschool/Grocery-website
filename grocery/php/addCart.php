<?php
		
		$id=$_POST['id'];
		if(isset($_POST['id'])){
			session_start();
			if(!isset($_SESSION['cart'])) {
			    $_SESSION['cart'] = array();
			}
			array_push($_SESSION['cart'], $id);
			$result=count($_SESSION['cart']);
			echo json_encode($result);
		}
		
?>