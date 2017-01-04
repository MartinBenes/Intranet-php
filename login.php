<?php
session_start();
require_once('connect.php');
if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM `user` WHERE username='$username' AND password='$password'";
	$result = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($result);
	
    /* pokud existuje dané uživatelské jméno v databázi
    a zároveň odpovídá heslo, vytvoří se session, který nese jméno loginu */
    if($count == 1){
        $_SESSION['username'] = $username;
	}else{
		$fmsg = "Špatné uživatelské jméno/heslo";
	}
}
// session už je vytvořený = uživatel už je přihlášený
if(isset($_SESSION['username'])){
	$smsg = "Uživatel už je přihlášen";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Přihlásit</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	

	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
    
    <!-- zprávy o stavu přihlášení -->
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
    
    <!-- formulář, POST -->
    <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Přihlásit / Registrovat</h2>
            <!-- přihlašovací jméno -->
		  <input type="text" name="username" class="form-control" placeholder="Uživatelské jméno" required>
		<!-- label + input pro heslo -->
        <label for="inputPassword" class="sr-only">Heslo</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Heslo" required>
            <!--tlačítko pro přihlášení -->
          <button class="btn btn-lg btn-primary btn-block" type="submit">Přihlásit</button>
          <!-- přejít z přihlášení na registraci -->
        <a class="btn btn-lg btn-primary btn-block" href="register.php">Registrovat</a>
      </form>
    
    <?php
    
 /*   if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
echo "Hi " . $username . "";
echo "This is the Members Area";
echo "<a href='logout.php'>Logout</a>"; 
 
} */

        //pokud je už uživatel přihlášený - tj. máme uložený session, bude přesměrován na dashboard.php
   if ( isset($_SESSION['username'])!="" ) {
		header("Location: dashboard.php");
		exit;
	} 
    ?>
    
</div>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</body>
</html>