<?php
session_start();
//editor
if (isset($_SESSION['user'])) {
    if($_SESSION['user']!="admin"){
      header("Location:".'//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php"); die();
    }else{
      require 'php/functions.php';
      $items = getAvailableItems();
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
<h4 style="color: #b72525;padding-bottom: 10px;">ITEMS</h4>
<h5 style="padding-bottom: 10px;">Add New</h5>
  <form action="php/main.php" method="post" style="background-color: #fbfbfb;padding: 20px;">
    Name: <input type="text" pattern="[a-zA-Z][a-zA-Z ]+" name="name" style="padding:5px;" maxlength="10" required>
    Price: <input type="number" min="1.00" step="0.01" name="price" style="padding:5px;" max="99999" required>
    <?php $cats = getCategories(); ?>
    Category: <select name="type" required>
    <?php while($cat = $cats->fetch_array()){ ?>
                <option value="<?php echo $cat['name']?>" 
                <?php if($cat['name']==$item['category']){
                         echo "selected"; } ?>><?php echo $cat['name']?></option>
    <?php } ?>
              </select><br><br>
    Detail<br> <textarea rows="4" cols="30" name="detail" maxlength="100" required><?php echo $item['detail'] ?></textarea><br><br>
    <button type="submit" class="btn btn-primary" name="createItem" value="createItem">Create</button>
  </form>

  <div>
  <hr>
    <?php while($item = $items->fetch_array()){ ?>
    <div class="col-sm-3" style="margin-bottom: 10px;">
    <?php 
      $images = getItemImages($item['id']);
      if(($images->num_rows)!=0){ 
      $image=$images->fetch_assoc(); ?>
        <img src="php/<?php echo $image['url'] ?>" style=" height: 150px; width: 200px;" class="img-responsive">
<?php }else{ ?>
        <img src="http://placehold.it/460x250/E7E7E7/ffffff&text=HTML5" style=" height: 150px; width: 200px;" class="img-responsive">
<?php }
    ?>
        
        <input type="hidden" class="myid" value="<?php echo $item['id'] ?>">
        Name <?php echo $item['name'] ?><br>
        Price <?php echo $item['price'] ?><br>
        <a href="adminEditProduct.php?urlId=<?php echo $item['id']?>" title="Detail Edit">view_detail/edit</a>
    </div>
    <?php } ?>
  </div>
</div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>