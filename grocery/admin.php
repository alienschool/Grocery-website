<?php
session_start();
//editor
if (isset($_SESSION['user'])) {
    if($_SESSION['user']!="admin"){
      header("Location:".'//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php"); die();
    }else{
      include 'php/functions.php';
      $results=getOrders();
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
    <a href="admin.php" class="active"><span class="glyphicon glyphicon-home"></span> Home</a>
    <a href="adminUsers.php"><span class="glyphicon glyphicon-user"></span> Users Info</a>
    <a href="adminProducts.php"><span class="glyphicon glyphicon-shopping-cart"></span> Products</a>
    <a href="php/main.php?dologout"><span class="glyphicon glyphicon-log-out"></span> logout</a>
  </div>
</div>
<div class="col-sm-9">
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
                <td><?php echo $order['remarks'] ?></td>
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