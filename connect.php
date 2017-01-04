<?php
$connection = mysqli_connect('localhost', 'root', 'root');
if(!$connection){
	die("Připojení k databázi selhalo" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'mydb');
if(!$select_db){
	die("Výběr databáze selhal" . mysqli_error($connection));
}


/*

<?php
$connection = mysqli_connect('localhost', 'root', 'root');
if(!$connection){
	die("Připojení k databázi selhalo" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'alt');
if(!$select_db){
	die("Výběr databáze selhal" . mysqli_error($connection));
}

*/

?>