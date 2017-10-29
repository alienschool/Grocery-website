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
                <form id="myForm" action="php/doRegister.php" method="post">
                    <input type="text" name="name" style="background-color: white; padding: 10px 45px;margin-bottom: 5px;" placeholder="NAME" maxlength="50" required><br>
                    <input type="email" name="email" style="background-color: white; padding: 10px 45px;margin-bottom: 5px;" placeholder="EMAIL" maxlength="50" required><br>                
                    <input type="password" maxlength="10" style="background-color: white; padding: 10px 45px;" id="password" name="password" placeholder="PASSWORD" required><br>
                    <input type="password" maxlength="10" style="background-color: white; padding: 10px 45px;" id="confirmPassword" name="password" placeholder="PASSWORD" required><br><br>
                    <div class="error"><?= $errorMsg ?></div>
                    <button class="" style="background-color: #F40030;padding: 10px 45px;border: none;width: 240px; color:white;" type="submit" name="doRegister" value="doRegister">Register</button><br><br>
                    <a style="color: red;" href="index.php">Go to main site</a>
                </form>
  </div>       
  </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
$('document').ready(function(){
    var password = $('#password');
    var confirm_password = $('#confirmPassword');
    $('button[type="submit"]').click(function(e) {
          e.preventDefault();
          validatePassword();
      });

    function validatePassword(){
      if(password.val() != confirm_password.val()) {
        $('#confirmPassword').css("border", "2px solid #d9534f");
      } else {
        $('#confirmPassword').css("border", "2px solid #5cb85c");
        $("#myForm").submit();
      }
    } 
});
</script>
</html>