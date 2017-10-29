<?php
session_start();
require 'php/functions.php';
if(isset($_GET['urlSearch'])){
	$items = getAvailableItemsBySearch($_GET['urlSearch']);
}else if(isset($_GET['urlCategory'])){
	$items = getAvailableItemsByCategory($_GET['urlCategory']);
}else{
	$items = getAvailableItems();
	$user = getUserByEmail('abc');
	while($u = $user->fetch_array()){
		echo $u['name'];
	}
	
    
}
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
        <li class="active"><a href="index.php">Products <span class="sr-only">(current)</span></a></li>
        
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

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="images/s4.jpg?3" style="width: 100%" alt="Chania">
      
    </div>

    <div class="item">
      <img src="images/s5.jpg?2" style="width: 100%" alt="Chicago">
      
    </div>

    <div class="item">
      <img src="images/s3.jpg?2" style="width: 100%" alt="New York">
      
    </div>
  </div>

  <!-- Left and right controls -->
<!--   <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a> -->
</div>

<div class="row" style="padding-top: 30px;">

<div class="col-sm-12" style="text-align: center;margin: 0 auto;">
		<h4 style="color: #b72525;padding-bottom: 10px;">ITEMS</h4>
		<?php while($item = $items->fetch_array()){ ?>
		<div class="col-sm-3">
		<div class=" column productbox">
		    <?php 
      $images = getItemImages($item['id']);
      if(($images->num_rows)!=0){ 
      $image=$images->fetch_assoc(); ?>
        <img src="php/<?php echo $image['url'] ?>"  class="img-responsive">
    <?php }else{ ?>
            <img src="http://placehold.it/460x250/E7E7E7/ffffff&text=HTML5"  class="img-responsive">
    <?php }
        ?>
		    <input type="hidden" class="myid" value="<?php echo $item['id'] ?>">
		    <input type="hidden" class="myname" value="<?php echo 'name'.$item['name'] ?>">
		    <div class="producttitle"><?php echo $item['name'] ?></div>
		    <div class="productprice"><div class="pull-right"> 
		    <?php 
		    $key=array_search($item['id'],$_SESSION['cart']); 
		    if($key!==false){
		    	echo '<button onclick="event.stopPropagation();" class="addToCart btn btn-success btn-sm">Added</button>';
		    }else{
				echo '<button onclick="event.stopPropagation();" class="addToCart btn btn-danger btn-sm">Add to cart</button>';
		    	}
		    	 ?> 
		    </div><div class="pricetext">PKR <?php echo $item['price']; ?></div></div>
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
	var id= $(this).children('.myid').val();
	window.location.replace("productDetail.php?urlId="+id);
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