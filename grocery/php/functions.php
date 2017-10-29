<?php
require 'connect.php';

function getCategories(){
	global $db;
	$results = $db->query("SELECT * FROM `category`");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getItemCountByCategory($category){
	global $db;
	$results = $db->query("SELECT count(id) as totalItems FROM `item` where UPPER(category)=UPPER('$category') AND orderId is null");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getUserOrders($userId){
	global $db;
	$results = $db->query("SELECT io.*,i.id as ItemId,i.name as itemName,u.name as userName,u.email as userEmail,a.name,a.phone,a.postalAddress FROM `itemOrder` as io INNER JOIN `item` i on io.id=i.orderId  INNER JOIN `user` u on io.userId=u.id INNER JOIN `address` a on io.id=a.itemOrderId where io.userId=$userId");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function insertUser($name,$email,$password,$type){
	global $db;
	$results = $db->query("INSERT INTO `user`(`name`, `email`, `password`, `type`) VALUES ('$name','$email','$password','$type')");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function insertItemOrder($userId,$dateOrdered,$status){
	global $db;
	$results = $db->query("INSERT INTO `itemOrder`(`userId`, `dateOrdered`, `status`) VALUES ($userId,'$dateOrdered','$status')");
	if($results){
		$last_id = $db->insert_id;
	    return $last_id;
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function updateItemOrderRemarks($id,$dateReceived,$status,$remarks){
	global $db;
	$results = $db->query("UPDATE `itemOrder` SET `dateReceived`='$dateReceived',`remarks`='$remarks', `status`='$status' WHERE id=$id ");
	if($results){
	    return $results;
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getUser($id){
	global $db;
	$results = $db->query("SELECT * FROM `user` WHERE id=$id");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getUsers(){
	global $db;
	$results = $db->query("SELECT * FROM `user`");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getUserByEmail($email){
	global $db;
	$results = $db->query("SELECT * FROM `user` WHERE email='$email' ");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getUserByEmailPassword($email,$password){
	global $db;
	$results = $db->query("SELECT * FROM `user` WHERE email='$email' AND password='$password'");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getCartItems(){
	$ids = join("','",$_SESSION['cart']);
	global $db;
	$results = $db->query("SELECT * FROM item WHERE id IN ('$ids')");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function updateItem($id,$name,$detail,$price,$category){
	global $db;
	$results = $db->query("UPDATE `item` SET `name`='$name',`detail`='$detail',`price`='$price',`category`='$category' WHERE id=$id");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function updateItemOrderId($id,$orderId){
	global $db;
	$results = $db->query("UPDATE `item` SET `orderId`=$orderId WHERE id=$id");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getItem($id){
	global $db;
	$results = $db->query("SELECT * FROM `item` WHERE id=$id");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getAvailableItems(){
	global $db;
	$results = $db->query("SELECT * FROM item WHERE orderId is null");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getAvailableItemsByCategory($category){
	global $db;
	$results = $db->query("SELECT * FROM item WHERE orderId is null AND UPPER(category)=UPPER('$category')");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getAvailableItemsBySearch($search){
	global $db;
	$results = $db->query("SELECT * FROM item WHERE orderId is null AND name LIKE '%$search%'");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getItemImages($itemId){
	global $db;
	$results = $db->query("SELECT * FROM `itemImage` WHERE itemId=$itemId");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getOrders(){
	global $db;
	$results = $db->query("SELECT io.*,i.id as ItemId,i.name as itemName,u.name as userName,u.email as userEmail,a.name,a.phone,a.postalAddress FROM `itemOrder` as io INNER JOIN `item` i on io.id=i.orderId  INNER JOIN `user` u on io.userId=u.id INNER JOIN `address` a on io.id=a.itemOrderId");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function getItemImage($id){
	global $db;
	$results = $db->query("SELECT * FROM `itemImage` WHERE id=$id");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function insertItem($name,$detail,$price,$category){
	global $db;
	$datePosted= date('y-m-d');
	$results = $db->query("INSERT INTO `item`( `name`, `detail`, `price`, `category`, `datePosted`) VALUES('$name','$detail','$price','$category','$datePosted');");

	if($results){
		$last_id = $db->insert_id;
	    return $last_id;  
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function insertAddress($name,$phone,$postalAddress,$itemOrderId){
	global $db;
	$datePosted= date('y-m-d');
	$results = $db->query("INSERT INTO `address`( `name`, `phone`, `postalAddress`, `itemOrderId`) VALUES('$name','$phone','$postalAddress',$itemOrderId);");

	if($results){
		$last_id = $db->insert_id;
	    return $last_id; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function insertItemImage($url,$type,$itemId){
	global $db;
	$results = $db->query("INSERT INTO `itemImage` (`url`, `type`, `itemId`) VALUES ('$url','$type',$itemId)");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function deleteItemImage($id){
	global $db;
	$results = $db->query("DELETE FROM `itemImage` WHERE id=$id ");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}
function deleteItemImages($itemId){
	global $db;
	$results = $db->query("DELETE FROM `itemImage` WHERE itemId=$itemId ");
	if($results){
	    return $results; 
	}else{
	    print 'Error : ('. $db->errno .') '. $db->error;
	}
}

?>