<?php

require 'connect.php';
require 'functions.php';
//login_logout_start
if(isset($_GET['dologout'])){
  session_start();
  session_unset();
  session_destroy();   
     header('Refresh: 2; URL = ../login.php');
}
if(isset($_POST['action'])){
	$action = $_POST['action'];
	if($action=='signin'){
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $result=getUserByEmail($email);
    if(($result->num_rows)!=0){
    	$result=getUserByEmailPassword($email,$password);
    	if(($result->num_rows)!=0){
    		$user = $result->fetch_assoc();  		
    		session_start();
        	$_SESSION['user']=$user['type'];
        	$_SESSION['id']=$user['id'];
            echo json_encode($user['type']);
    	}else{
    		echo json_encode("wrong password");
    	}
    }else{
    	echo json_encode("wrong email");
    }
  }
}
if(isset($_POST['doRegister'])){
	$name = trim($_POST["name"]);
	$email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
	insertUser($name,$email,$password,'user');
	header('Refresh: 2; URL = ../login.php');
}
//login_logout_end
if(isset($_POST['removeCartItem'])){
	$action = $_POST['removeCartItem'];
	if($action=='removeCartItem'){
		$ids=$_POST["id"];
        $total=0.00;
    	session_start();
    	$key=array_search($ids,$_SESSION['cart']);
	    if($key!==false){
	    	unset($_SESSION['cart'][$key]);
	    	if(isset($_SESSION['cart'])){ 
                $items = getCartItems();
               while($item = $items->fetch_array()){ 
                 $total= $total + $item['price'];
                }
        		//$result=count($_SESSION['cart']);
            }
            $result=$total;
	    }else{
	    	$result="not found";
	    }
	    $_SESSION["cart"] = array_values($_SESSION["cart"]);
         echo json_encode($result);
  }
}
if(isset($_POST['createItem'])){
	$name = trim($_POST["name"]);
	$detail = trim($_POST["detail"]);
    $price = trim($_POST["price"]);
    $category = trim($_POST["type"]);
	$id=insertItem($name,$detail,$price,$category);
	header("Location:../adminEditProduct.php?urlId=".$id);
}
if(isset($_POST['updateItem'])){
	    $id=$_POST["id"];
		$name = trim($_POST["name"]);
		$detail = trim($_POST["detail"]);
	    $price = trim($_POST["price"]);
	    $category = trim($_POST["type"]);
    	updateItem($id,$name,$detail,$price,$category);
    	header("Location:../adminEditProduct.php?urlId=".$id);
  
}
if(isset($_POST['uploadImage'])){
    $id = $_POST["itemId"];
	$path = $_FILES['upload']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	$filename=date("Y-m-d h:i:sa");
	$target_file = "uploads/".$filename.".".$ext;
	if (move_uploaded_file($_FILES['upload']['tmp_name'], __DIR__.'/'.$target_file)) {
        insertItemImage($target_file,$ext,$id);
        header("Location:../adminEditProduct.php?urlId=".$id);
    } else {
        echo "error";
    }
}
if(isset($_POST['deleteItemImage'])){
    $url = trim($_POST["url"]);
    $itemId = trim($_POST["itemId"]);
    $id = trim($_POST["id"]);
    $result=getItemImage($id);
    if(($result->num_rows)!=0){
        $image = $result->fetch_assoc();
        unlink($url);
        deleteItemImage($id);
    }
	header("Location:../adminEditProduct.php?urlId=".$itemId);
}
if(isset($_POST['checkout'])){
    $dateOrdered=date("Y-m-d");
    session_start();
    $userId = $_SESSION['id'];
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $postalAddress = trim($_POST["postalAddress"]);
    
    $orderId = insertItemOrder($userId,$dateOrdered,"pending");
    insertAddress($name,$phone,$postalAddress,$orderId);
    $result = getCartItems();
    while($item = $result->fetch_array()){ 
        updateItemOrderId($item['id'],$orderId);    
    }
    unset($_SESSION['cart']);
    header("Location:../user.php");
}
if(isset($_POST['received'])){
    $remarks = trim($_POST["remarks"]);
    $orderId = trim($_POST["orderId"]);
    $dateReceived=date("Y-m-d");
    updateItemOrderRemarks($orderId,$dateReceived,"received",$remarks);
    header("Location:../user.php");
}

?>