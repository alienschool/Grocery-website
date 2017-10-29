<?php

session_start();
if(isset($_SESSION['cart']) && count($_SESSION['cart'])!=0){
	require 'php/functions.php';
  $items = getCartItems();	
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Grocery</title>
	<link rel="stylesheet" href="css/style.css?1.2">
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
        	<li ><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart 
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
<div class="col-sm-8">
	<?php if(isset($_SESSION['cart'])){ ?>
        		<h4><span id="itemsInCart"><?php echo count($_SESSION['cart']); ?></span> items in cart</h4>
     <?php } ?>
	<?php
  $total=0.00;
   while($item = $items->fetch_array()){ 
   $total= $total + $item['price']; ?>
		<div class="finalCart row" style="margin: 10px auto; background-color: #fcf8e3;">
		<div class="col-sm-3">
    <?php 
      $images = getItemImages($item['id']);
      if(($images->num_rows)!=0){ 
      $image=$images->fetch_assoc(); ?>
        <img src="php/<?php echo $image['url'] ?>" style="margin-top: 10px;" class="img-responsive">
<?php }else{ ?>
        <img src="http://placehold.it/460x250/E7E7E7/ffffff&text=HTML5" style="margin-top: 10px;" class="img-responsive">
<?php }
    ?>
		</div>
		<div class="col-sm-3">
			<h4 style="color: #5cb85c;"><?php echo $item['name'] ?></h4>
			<p><?php echo $item['detail'] ?></p>
		</div>
		<div class="col-sm-3">
			<h4 style="color: #b73425;">PKR <?php echo $item['price'] ?>/-</h4>
		</div>
		<div class="col-sm-3">
			<button class="removeButton btn btn-warning" style="margin-top: 10px;">Remove</button>
		</div>
		<input type="hidden" class="myid" value="<?php echo $item['id'] ?>">
		<hr>
		</div>
		
	<?php } ?>
</div>

<div class="col-sm-4">
	<div style="border-bottom: 5px solid #5cb85c;"><h4>Cart Summary</h4></div>
	<div class="row" style="margin:0px auto; background-color: #f7f7f7;padding-bottom:10px;">
		<div class="col-sm-12">
			<p><a href="login.php">Login</a> or <a href="signup.php">Register</a> in order to checkout.</p>
      <?php $myitems = getCartItems();
      while($item = $myitems->fetch_array()){ ?>
      <div id="subtotalItem<?php echo $item['id'] ?>">
      <h5 style="color: #5cb85c;"><?php echo $item['name'] ?> PKR <?php echo $item['price'] ?></h5>
      </div>
     <?php } ?>
			<h4 id="subtotal">Item subtotal &nbsp;&nbsp;&nbsp;<?php echo $total?></h4><br>
      <p><b>Payment Method</b> Cash on Delivery</p>
			<h3 id="total" style="color: #b73425;">Total &nbsp;&nbsp;PKR <?php echo $total?></h3>
      <?php if(isset($_SESSION['user'])) { ?>
              <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Chcekout</button>
        <?php } else{ ?>
              <button class="btn btn-success" onclick='window.location.replace("login.php");'>Login to Chcekout</button>
          <?php } ?>
			
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div id="DivIdToPrint" class="modal-content">
    <form action="php/main.php" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;">GROCERY Invoice</h4>
      </div>
      <div class="modal-body">
      <p>Postal Information</p>
      <input type="hidden" name="invoiceUserId" value="<?php echo $item['id'] ?>">
      <input id="invoiceName" name="name" type="text" placeholder="Name" class="input-xlarge" required="">
      <input id="invoicePhone" name="phone" type="tel" placeholder="Phone" class="input-xlarge" required="">
      <input id="invoiceAddress" name="postalAddress" type="text" placeholder="Postal Address" class="input-xlarge" required="">
      <br>Name <p id="invoiceNameP" style="display: inline-block;"></p><br>Phone <p id="invoicePhoneP" style="display: inline-block;"></p><br>Address <p id="invoiceAddressP" style="display: inline-block;"></p>
      <hr>
      <p>Items</p>
      <table cellpadding="10" cellspacing="0" style="border:1px solid #e7e7e7;width: 100%">
      <thead style="background-color: #e7e7e7;">
        <td>Product</td>
        <td>Price</td>
        <td>Order</td>
      </thead>
    <?php $xitems = getCartItems();

    while($item = $xitems->fetch_array()){ ?>
        <tr id="invoiceItem<?php echo $item['id'] ?>">
        <input type="hidden" name="invoiceId" value="<?php echo $item['id'] ?>">
          <td><?php echo $item['name'] ?></td>
          <td><?php echo $item['price'] ?></td>
          <td>Cash on Delivery</td>
        </tr>
     <?php } ?>
      </table>
     <h3 id="invoiceTotal">Total &nbsp;&nbsp;PKR <?php echo $total?></h3>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-success" name="checkout" value="checkout">Checkout</button>
      <button type="button" onclick='printDiv();' class="btn btn-default">Print</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  
  </div>
</div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
$('#invoiceName').on('input',function(e){
    $('#invoiceNameP').html($('#invoiceName').val());
});
$('#invoicePhone').on('input',function(e){
    $('#invoicePhoneP').html($('#invoicePhone').val());
});
$('#invoiceAddress').on('input',function(e){
    $('#invoiceAddressP').text($('#invoiceAddress').val());
});
function printDiv() {
  $('#invoiceName').hide();
  $('#invoicePhone').hide();
  $('#invoiceAddress').hide();

     var divToPrint=document.getElementById('DivIdToPrint');

    var newWin=window.open('','Print-Window');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

    newWin.document.close();
  $('#invoiceName').show();
  $('#invoicePhone').show();
  $('#invoiceAddress').show();

    setTimeout(function(){newWin.close();},10);
}

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

	$('.removeButton').click(function() {
		var myThis=$(this).closest('.finalCart');
    
		var id = $(this).closest('.finalCart').children('.myid').val();
                if (1==1) {
                  	$.ajax({
                      url: 'php/main.php',
                      data: {"removeCartItem":"removeCartItem", "id":id},
                      type: 'post',
                      success: function(result)
                      {
                         if(JSON.parse(result)!="not found"){
                            myThis.closest('.finalCart').remove();
                            $('#total').html("Total &nbsp;&nbsp;PKR "+result);
                            $('#subtotal').html("Item subtotal &nbsp;&nbsp;&nbsp; "+result);
                            $('#subtotalItem'+id).remove();
                            $('#invoiceItem'+id).remove();
                            $('#invoiceTotal').html("Total &nbsp;&nbsp;PKR"+result);
                            var itemsInCart=parseInt($('#itemsInCart').text());
                            itemsInCart--;
                            $('#itemsInCart').text(itemsInCart);
                         }else{
                          alert(result);
                         }                                                  
                      }
                    });                               
                } else {
                    
                }
            });
</script>
</html>