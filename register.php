<?php
require_once('connect.php');
if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = md5($_POST['password']);

	$sql = "INSERT INTO `user` (username, email, password) VALUES ('$username', '$email', '$password')";
	$result = mysqli_query($connection, $sql);
	if($result){
		$smsg = "Registrace byla úspěšná.";
	}else{
		$fmsg = "Registrace se nezdařila. Uživatelské jméno je již používano.";
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Registrace</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Registrace</h2>
       
		
		  <input type="text" name="username" class="form-control" placeholder="Uživatelské jméno" required>
		
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Heslo</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Heslo" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registrovat</button>
        <a class="btn btn-lg btn-primary btn-block" href="login.php">Přihlásit</a>
      </form>
</div>
</body>
</html>