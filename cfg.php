<?php
   
	session_start();
	require_once 'connect.php';
   
	
	// pokud není nastavený session = uživatel není přihlášen -> bude přesměrován na stránku s loginem
	if( !isset($_SESSION['username']) ) {
		header("Location: login.php");
		exit;
	}


    // v session je uložené uživatelské jméno - může se zobrazit
    $username = $_SESSION['username'];


   // odeslání nového příspěvku

if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = md5($_POST['password']);

	$sql = "UPDATE user SET (username, email, password) VALUES ('$username', '$email', '$password')";
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vítejte</title>
<link rel="stylesheet" href="styles.css" type="text/css" />

    
    <!-- bootstrap css framework -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	
</head>
<body>


    
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Navigace</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="news.php">Novinky</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="Allposts.php">Všechny příspěvky</a></li>
            <li><a href="posts.php">Moje příspěvky a komentáře</a></li>
            <li><a href="cfg.php">Nastavení</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown"> <!-- dropdown tlačtko na odhlášení + zobrazené jméno uživatele -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span><?php echo " " . "$username";?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>Odhlásit</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav> 

	<div id="wrapper">

	<div class="container">
    
        <!-- kontrola přihlášeného uživatele, než vloží příspěvek -->
    	<div class="page-header">
    	<h6><?php echo "Jste přihlášen/a jako <bold>" . $username . "</bold> nejste to vy? ";?> <br> <a href="logout.php?logout"><span class="glyphicon"></span>Odhlásit</a></h6>
    	</div>
        
        
        
        <div class="row">
        <div class="col-lg-4">
        <h3>Nový příspěvek</h3>
            
            <!-- stavové zprávy o zápisu do databáze -->
           <div class="container">
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Upravit profil</h2>
       
		
		  <input type="text" name="username" class="form-control" placeholder="Uživatelské jméno" required>
		
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Heslo</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Heslo" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Změnit</button>
      </form>
</div>
        </div>
        </div>
    
    </div>
    
    </div>
    
    <!-- JS Bootstrap a jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    
</body>
</html>
