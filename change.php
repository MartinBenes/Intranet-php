<?php
if(isset($_POST) & !empty($_POST)){
	$username_new = mysqli_real_escape_string($connection, $_POST['username']);
	$email_new = mysqli_real_escape_string($connection, $_POST['email']);
	$password_new = md5($_POST['password']);

	$sql = "INSERT INTO `user` (username, email, password) VALUES ('$username_new', '$email_new', '$password_new')";
	$result = mysqli_query($connection, $sql);
}