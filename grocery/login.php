<?php
session_start();
if (isset($_SESSION['user'])) {
    if($_SESSION['user']=="admin"){
        header("Location:".'//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin.php"); die();
    }else{
        header("Location:".'//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php"); die();
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
  <link rel="stylesheet" href="css/style.css">
</head>
<body style="margin-top: 60px;">  
  <div class="container">
  <div class="col-sm-8 col-sm-offset-2" style="text-align: center;">
        <div class="avatar" >
        <img style="width: 200px;margin-bottom: 10px; border: none;" src="images/logo.png?id=2" alt="Grocery"> </div>
                <form action="" method="post">
                    <input type="text" name="email" style="background-color: white; padding: 10px 45px;margin-bottom: 5px;" placeholder="EMAIL/USERNAME" maxlength="50" required><br>
                
                    <input type="password" maxlength="10" style="background-color: white; padding: 10px 45px;" name="password" placeholder="PASSWORD" required><br><br>
                    <div class="error"><?= $errorMsg ?></div>
                    <button class="" style="background-color: #F40030;padding: 10px 45px;border: none;width: 240px; color:white;" type="submit">Login</button><br><br><div style="text-align: left;    margin: 0 auto;width: 240px;">
                    <a style="color: red;" href="index.php">Go to main site</a>
                    <a style="float:right; color: red;" href="signup.php">Register</a>
                    </div>
                </form>
  </div>       
  </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">
     $(function(){
        var email = $("input[name=email]");
        var password = $("input[name=password]");
        $('button[type="submit"]').click(function(e) {
                e.preventDefault();
                //little validation just to check username
                if (email.val() !="" && password.val!="") {
                    $.ajax
                    ({
                      url: 'php/main.php?signin',
                      data: {"action":'signin', "email":email.val(), "password": password.val()},
                      type: 'post',
                      success: function(result)
                      {
                         if(JSON.parse(result)=="admin"){
                          window.location.replace("admin.php");
                         }else if(JSON.parse(result)=="user"){
                          window.location.replace("user.php");
                         }else{
                          alert(result + email.val() + password.val());
                         }                                                  
                      }
                    });                               
                } else {
                    //remove success mesage replaced with error message
                    $("#output").removeClass(' alert alert-success');
                    $("#output").addClass("alert alert-danger animated fadeInUp").html("Enter all information ");
                }
                //console.log(name.val());
            });
      });
</script>
</html>