<?php
session_start();
//editor
if (isset($_SESSION['user'])) {
    if($_SESSION['user']!="admin"){
      header("Location:".'//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php"); die();
    }else{
    	include 'php/functions.php';
		if(isset($_GET['urlId'])){
			$result = getItem($_GET['urlId']);
			$images = getItemImages($_GET['urlId']);
		}else{
			echo 'Product not found';
		}
    }
}else{
  header("Location:".'//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/login.php"); die();
} 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Grocery</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<style type="text/css">
  .vertical-menu {
    /*width: 200px;*/ /* Set a width if you like */
    position:fixed;
  width: 250px;
  z-index: 1000;
  left: 0;
  top: 0;
  padding-top: 50px;
  height: 100%;
  background-color: #009D95;
}

.vertical-menu a {
    background-color: #009D95; /* Grey background color */
    color: white; /* Black text color */
    display: block; /* Make the links appear below each other */
    padding: 12px; /* Add some padding */
    text-decoration: none; /* Remove underline from links */
}

.vertical-menu a:hover {
    background-color: #6ab3af; /* Dark grey background on mouse-over */
}

.vertical-menu a.active {
    background-color: white; /* Add a green color to the "active/current" link */
    color: #b72525;
}
</style>
<div style="text-align: right;background-color: #b72525;padding: 5px;">
  <a href="php/main.php?dologout" style="color: white;"><span class="glyphicon glyphicon-log-out"></span> logout</a>
</div>
<div class="row">
<div class="col-sm-3">
  <div class="vertical-menu">
    <a href="admin.php"><span class="glyphicon glyphicon-home"></span> Home</a>
    <a href="adminUsers.php"><span class="glyphicon glyphicon-user"></span> Users Info</a>
    <a href="adminProducts.php" class="active"><span class="glyphicon glyphicon-shopping-cart"></span> Products</a>
    <a href="php/main.php?dologout"><span class="glyphicon glyphicon-log-out"></span> logout</a>
  </div>
</div>
<div class="col-sm-9">
<h5 style="padding-bottom: 10px;">Item Detail</h5>
<?php while($item = $result->fetch_array()){ ?>
	<form action="php/main.php" method="post">
		<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
        Name: <input type="text" pattern="[a-zA-Z][a-zA-Z ]+" name="name" value="<?php echo $item['name'] ?>" style="padding:5px;" maxlength="10" required>
    Price: <input type="number" min="1.00" step="0.01" name="price" value="<?php echo $item['price'] ?>" style="padding:5px;" max="99999" required>
    <?php $cats = getCategories(); ?>
    Category: <select name="type" required>
    <?php while($cat = $cats->fetch_array()){ ?>
                <option value="<?php echo $cat['name']?>" 
                <?php if($cat['name']==$item['category']){
                         echo "selected"; } ?>><?php echo $cat['name']?></option>
    <?php } ?>
              </select><br><br>
        Detail<br> <textarea rows="5" cols="50" maxlength="100" name="detail"><?php echo $item['detail'] ?></textarea><br><br><br>
        <button type="submit" class="btn btn-primary" name="updateItem" value="updateItem">Update</button>
    </form>
<?php } ?><hr>

<h5 style="padding-bottom: 10px;">Add New Image</h5>
<form id="imageForm" action="php/main.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="itemId" value="<?php echo $_GET['urlId'] ?>">
        <input type="hidden" name="uploadImage" value="uploadImage">
        <input style="display: inline-block;" type="file" name="upload" value="Choose a file" required>
        <button type="submit" class="btn btn-primary" name="uploadImage" value="uploadImage">Publish</button>
</form><hr>

<h5 style="padding-bottom: 10px;">Item Images</h5>
<?php 
if(($images->num_rows)!=0){
while($item = $images->fetch_array()){ ?>
<div class="col-sm-4">
	<form style="margin:5px;" action="php/main.php" method="post">
	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	<input type="hidden" name="itemId" value="<?php echo $_GET['urlId'] ?>">
  <input type="hidden" name="url" value="<?php echo $item['url'] ?>">
	<img src="php/<?php echo $item['url'] ?>" style="width: 200px;">
	<button type="submit" style="border-radius: 20px;" class="btn btn-danger" name="deleteItemImage" value="deleteItemImage">X</button>
	</form>
</div>
<?php }
} else{ ?>
      <h4>no images available</h4>
<?php } ?>
</div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
  window.URL = window.URL || window.webkitURL;

$("#imageForm").submit( function( e ) {
    var form = this;
    e.preventDefault(); //Stop the submit for now
                                //Replace with your selector to find the file input in your form
    var fileInput = $(this).find("input[type=file]")[0],
        file = fileInput.files && fileInput.files[0];

    if( file ) {
        var img = new Image();

        img.src = window.URL.createObjectURL( file );

        img.onload = function() {
            var width = img.naturalWidth,
                height = img.naturalHeight;

            window.URL.revokeObjectURL( img.src );

            if( width == 460 && height == 250 ) {
                form.submit();
            }
            else {
                alert("please upload only 460x250");
            }
        };
    }
    else { //No file was input or browser doesn't support client side reading
        form.submit();
    }

});
</script>
</html>