<?php
session_start();
include 'php/functions.php';
if(isset($_GET['urlId'])){
	$result = getItem($_GET['urlId']);
	$images = getItemImages($_GET['urlId']);

}else{
	echo 'Product not found';
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
	<style type="text/css" media="screen">

	/*****************globals*************/
	body {
	  font-family: 'open sans';
	  overflow-x: hidden; }

	img {
	  max-width: 100%; }

	.preview {
	  display: -webkit-box;
	  display: -webkit-flex;
	  display: -ms-flexbox;
	  display: flex;
	  -webkit-box-orient: vertical;
	  -webkit-box-direction: normal;
	  -webkit-flex-direction: column;
	      -ms-flex-direction: column;
	          flex-direction: column; }
	  @media screen and (max-width: 996px) {
	    .preview {
	      margin-bottom: 20px; } }

	.preview-pic {
	  -webkit-box-flex: 1;
	  -webkit-flex-grow: 1;
	      -ms-flex-positive: 1;
	          flex-grow: 1; }

	.preview-thumbnail.nav-tabs {
	  border: none;
	  margin-top: 15px; }
	  .preview-thumbnail.nav-tabs li {
	    width: 18%;
	    margin-right: 2.5%; }
	    .preview-thumbnail.nav-tabs li img {
	      max-width: 100%;
	      display: block; }
	    .preview-thumbnail.nav-tabs li a {
	      padding: 0;
	      margin: 0; }
	    .preview-thumbnail.nav-tabs li:last-of-type {
	      margin-right: 0; }

	.tab-content {
	  overflow: hidden; }
	  .tab-content img {
	    width: 100%;
	    -webkit-animation-name: opacity;
	            animation-name: opacity;
	    -webkit-animation-duration: .3s;
	            animation-duration: .3s; }

	.card {
	  margin-top: 50px;
	  background: #eee;
	  padding: 3em;
	  line-height: 1.5em; }

	@media screen and (min-width: 997px) {
	  .wrapper {
	    display: -webkit-box;
	    display: -webkit-flex;
	    display: -ms-flexbox;
	    display: flex; } }

	.details {
	  display: -webkit-box;
	  display: -webkit-flex;
	  display: -ms-flexbox;
	  display: flex;
	  -webkit-box-orient: vertical;
	  -webkit-box-direction: normal;
	  -webkit-flex-direction: column;
	      -ms-flex-direction: column;
	          flex-direction: column; }

	.colors {
	  -webkit-box-flex: 1;
	  -webkit-flex-grow: 1;
	      -ms-flex-positive: 1;
	          flex-grow: 1; }

	.product-title, .price, .sizes, .colors {
	  text-transform: UPPERCASE;
	  font-weight: bold; }

	.checked, .price span {
	  color: #ff9f1a; }

	.product-title, .rating, .product-description, .price, .vote, .sizes {
	  margin-bottom: 15px; }

	.product-title {
	  margin-top: 0; }

	.size {
	  margin-right: 10px; }
	  .size:first-of-type {
	    margin-left: 40px; }

	.color {
	  display: inline-block;
	  vertical-align: middle;
	  margin-right: 10px;
	  height: 2em;
	  width: 2em;
	  border-radius: 2px; }
	  .color:first-of-type {
	    margin-left: 20px; }

	.add-to-cart, .like {
	  background: #ff9f1a;
	  padding: 1.2em 1.5em;
	  border: none;
	  text-transform: UPPERCASE;
	  font-weight: bold;
	  color: #fff;
	  -webkit-transition: background .3s ease;
	          transition: background .3s ease; }
	  .add-to-cart:hover, .like:hover {
	    background: #b36800;
	    color: #fff; }

	.not-available {
	  text-align: center;
	  line-height: 2em; }
	  .not-available:before {
	    font-family: fontawesome;
	    content: "\f00d";
	    color: #fff; }

	.orange {
	  background: #ff9f1a; }

	.green {
	  background: #85ad00; }

	.blue {
	  background: #0076ad; }

	.tooltip-inner {
	  padding: 1.3em; }

	@-webkit-keyframes opacity {
	  0% {
	    opacity: 0;
	    -webkit-transform: scale(3);
	            transform: scale(3); }
	  100% {
	    opacity: 1;
	    -webkit-transform: scale(1);
	            transform: scale(1); } }

	@keyframes opacity {
	  0% {
	    opacity: 0;
	    -webkit-transform: scale(3);
	            transform: scale(3); }
	  100% {
	    opacity: 1;
	    -webkit-transform: scale(1);
	            transform: scale(1); } }

	/*# sourceMappingURL=style.css.map */
		
	</style>
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
<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						<?php if(($images->num_rows)!=0){ 
							$image=$images->fetch_assoc(); ?>
								<div class="tab-pane active" id="pic-1"><img src="php/<?php echo $image['url'] ?>" /></div>
							<?php }else{ ?>
								<div class="tab-pane active" id="pic-1"><img src="http://placekitten.com/400/252" /></div>
							<?php } if(($images->num_rows)!=0){ 

						      while($image=$images->fetch_assoc()){ ?>
						        <div class="tab-pane" id="pic-2"><img src="php/<?php echo $image['url'] ?>" /></div>
							<?php }
							
							}else{ ?>
						        <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
						<?php }
						    ?>
						</div>
						<ul class="preview-thumbnail nav nav-tabs">
						<?php $imagex = getItemImages($_GET['urlId']); 
						if(($imagex->num_rows)!=0){ 

							$image=$imagex->fetch_assoc(); ?>
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="php/<?php echo $image['url'] ?>" /></a></li>

						  <?php }else{ ?>

						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>

						  <?php } if(($imagex->num_rows)!=0){ 

						      while($image=$imagex->fetch_assoc()){ ?>
						        <li><a data-target="#pic-2" data-toggle="tab"><img src="php/<?php echo $image['url'] ?>" /></a></li>
							<?php }

							}else{ ?>
						        <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						<?php }
						    ?>
						</ul>
						
					</div>
					<?php while($item = $result->fetch_array()){ ?>
					<div class="details col-md-6">
					<input type="hidden" id="id" value="<?php echo $item['id'] ?>">
						<h3 class="product-title"><?php echo $item['name'] ?></h3>
						
						<p class="product-description"><?php echo $item['detail'] ?></p>
						<h4 class="price">current price: <span>PKR <?php echo $item['price'] ?></span></h4>
						
						<div class="action">
							<?php 
						    $key=array_search($item['id'],$_SESSION['cart']); 
						    if($key!==false){
						    	echo '<button class="addToCart btn btn-success btn-sm">Added</button>';
						    }else{
								echo '<button class="addToCart btn btn-danger btn-sm">Add to cart</button>';
						    	} ?> 
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
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

	$('.addToCart').click(function() {
		var thisButton= $(this);
		if(thisButton.html()!=='Added'){
		var id = $('#id').val();
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