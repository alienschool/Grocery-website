<?php
session_start();
//editor
if (isset($_SESSION['user'])) {
    if($_SESSION['user']!="admin"){
      header("Location:".'//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php"); die();
    }else{
      require 'php/functions.php';
      $users = getUsers();

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
html, body, .container-fluid, .row {
    height: 100%;
}
</style>
<div style="text-align: right;background-color: #b72525;padding: 5px;">
  <a href="php/main.php?dologout" style="color: white;"><span class="glyphicon glyphicon-log-out"></span> logout</a>
</div>
<div class="row">
<div class="col-sm-3">
  <div class="vertical-menu">
    <a href="admin.php"><span class="glyphicon glyphicon-home"></span> Home</a>
    <a href="adminUsers.php" class="active"><span class="glyphicon glyphicon-user"></span> Users Info</a>
    <a href="adminProducts.php"><span class="glyphicon glyphicon-shopping-cart"></span> Products</a>
    <a href="php/main.php?dologout"><span class="glyphicon glyphicon-log-out"></span> logout</a>
  </div>
</div>
<div class="col-sm-9">
    <h4 style="color: #b72525;padding-bottom: 10px;">Users</h4>
    <?php while($user = $users->fetch_array()){ ?>
    <div class="col-sm-4 column" style="margin:10px; min-width: 200px; width: fit-content;padding:50px;text-align: center;background-color: #fbfbfb;">
        <span class="glyphicon glyphicon-user fa-2x"></span><h4><?php echo $user['name'] ?></h4>
        <h5>(<?php echo $user['type']; ?>)</h5>
        <input type="hidden" class="myid" value="<?php echo $item['id'] ?>">
        <div><?php echo $user['email']; ?></div>
        
    </div>
    <?php } ?>
</div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>