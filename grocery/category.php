<?php
session_start();
require 'php/functions.php';

	$items = getCategories();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Grocery</title>
	<link rel="stylesheet" href="css/style.css?2.0">
</head>
<body>
	<div style="text-align: center;background-color: #b72525;padding: 0px 10px;">
	
  <a href="#" target="_self" >
  <i style="color: white;margin: 5px;" class="fa fa-facebook-square fa-lg" aria-hidden="true"></i>
  </a>
  <a href="#" target="_self" >
  <i style="color: white;margin: 5px;" class="fa fa-twitter-square fa-lg" aria-hidden="true"></i>
  </a>
  <a href="#" target="_self" >
  <i style="color: white;margin: 5px;" class="fa fa-google-plus-square fa-lg" aria-hidden="true"></i>
  </a>
  </div>
<nav class="navbar navbar-default" style="margin-bottom: 5px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="category.php" style="color: #b72525;">Grocery</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Products <span class="sr-only">(current)</span></a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        	<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart 
        		<?php if (isset($_SESSION['cart'])){ ?>
        		<span class="cartCount alert alert-danger"><?php echo count($_SESSION['cart']); ?></span>
        	<?php } ?>
        		</a></li>
        <?php if (isset($_SESSION['user'])){ ?>
          <li><a href="user.php">My Orders</a></li>
        	<li><a href="php/main.php?dologout"><span class="glyphicon glyphicon-log-out"></span> logout</a></li>
      	<?php }else{ ?>
        	<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> login</a></li>
       	<?php } ?>
        
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li> -->
      </ul>
      <div class="navbar-form navbar-right">
        <div class="form-group has-feedback">
          <input id="searchInput" type="text" class="form-control" placeholder="Search">
          <i id="searchButton" class="glyphicon glyphicon-search form-control-feedback"></i>
        </div>
        
      </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="col-sm-12" style="text-align: center;">
 <div style="margin-top: 60px; margin-bottom: 60px;">
   <h1>How It Works</h1>
 </div>
 <div class="col-sm-4" >
 <i class="fa fa-laptop fa-5x" aria-hidden="true"></i>
   <h3>PLACE YOUR ORDER HERE</h3>
   <p>Conveniently use your computer to place your order online</p>
 </div>
 <div class="col-sm-4" >
 <i class="fa fa-truck fa-5x" aria-hidden="true"></i>
   <h3>DELIVERY WITHIN 2 HOURS</h3>
   <p>Our commitment is to deliver your order at your door step within 2 hours</p>
 </div>
 <div class="col-sm-4" >
 <i class="fa fa-money fa-5x" aria-hidden="true"></i>
   <h3>PAY CASH AT YOUR DOORSTEP</h3>
   <p>Once you are satisfied with the order, our service & quality, pay cash on the spot upon delivery</p>
 </div>
</div>

<div class="row" style="padding-top: 60px;">
<div class="col-sm-12" style="text-align: center;margin: 0 auto;padding: 5px 10px;">
		<h2 style="color: #b72525;padding-bottom: 10px;">Choose A Category</h2>
		<?php while($item = $items->fetch_array()){ ?>
		<div class="col-sm-4">
		<div class=" column productbox">
        <img src="php/<?php echo $item['image'] ?>"  class="img-responsive">
		    <input type="hidden" class="myid" value="<?php echo $item['id'] ?>">
		    <input type="hidden" class="myname" value="<?php echo $item['name'] ?>">
        <div class="producttitle">
        <?php 
          $count=getItemCountByCategory($item['name']);
      if(($count->num_rows)!=0){ 
      $mycount=$count->fetch_assoc();
        echo $mycount['totalItems']." items found";
      } else {
        echo "0 items";
        }?>
		    </div>
		    <div class="productprice"><div class="pull-right"> 
		    </div><div class="pricetext"> <?php echo $item['name']; ?></div></div>
		</div>
		</div>
		<?php } ?>
		
</div>
</div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
$('document').ready(function(){
    $('#searchButton').click(function(){
        var search = $('#searchInput').val();
        alert(search);
        window.location.replace("index.php?urlSearch="+search);
    });
    $('#searchInput').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            $('#searchButton').click();//Trigger search button click event
        }
    });

});

$('.productbox').click(function(){
	var id= $(this).children('.myname').val();
	window.location.replace("index.php?urlCategory="+id);
});

	$('.addToCart').click(function() {
		var thisButton= $(this);
		if(thisButton.html()!=='Added'){
		var id = $(this).closest('.productbox').children('.myid').val();
		var name = $(this).closest('.productbox').children('.myname').val();
                  	$.ajax({
                      url: 'php/addCart.php',
                      data: {"id":id, "name": name},
                      type: 'post',
                      success: function(result)
                      {
                         $('.cartCount').text(JSON.parse(result));
                         thisButton.html('Added');
                         thisButton.removeClass('btn-danger');
                         thisButton.addClass('btn-success');
                      }
                    });
        }else{
        	alert("already in the cart");
        }
    });
</script>
</html>