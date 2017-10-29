<?php
session_start();
//editor
if (isset($_SESSION['user'])) {
    if($_SESSION['user']!="user"){
      header("Location:".'//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php"); die();
    }else{
      include 'php/functions.php';
      $results=getUserOrders($_SESSION['id']);
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
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css">
  <link rel="stylesheet" href="css/style.css">
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
      <a class="navbar-brand" href="index.php" style="color: #b72525;">Grocery</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Products <span class="sr-only">(current)</span></a></li>
        <!-- <li><a href="#">About</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
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
<div class="row">
<div class="col-sm-12">
<h4 style="color: #b72525;padding-bottom: 10px;">Orders</h4>
  <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>User</th>
                <th>Address</th>
                <th>Date Ordered</th>
                <th>Date Received</th>
                <th>Status</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
        <?php if(($results->num_rows)!=0){ 
        while($order = $results->fetch_array()){ ?>
            <tr>
                <td><?php echo $order['userName'].'<br>'.$order['userEmail'] ?></td>
                <td><?php echo $order['name'].'<br>'.$order['phone'].'<br>'.$order['postalAddress'] ?></td>
                <td><?php echo $order['dateOrdered'] ?></td>
                <td><?php echo $order['dateReceived'] ?></td>
                <td><?php echo $order['status'] ?></td>
                <?php if($order['status']!='pending'){ ?>
                <td><?php echo $order['remarks'] ?></td>
                <?php }else{ ?>
                <td>
                <form action="php/main.php" method="post">
                <input type="hidden" name="orderId" value="<?php echo $order['id'] ?>">
                <input type="text" name="remarks" placeholder="Remarks"><br>
                <button type="submit" class="btn btn-primary" name="received" value="received">Received</button>
                </form>
                </td>
                <?php } ?>
                
            </tr>
        <?php } } ?>
        </tbody>
  </table>
</div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
    } );
} );
</script>
</html>