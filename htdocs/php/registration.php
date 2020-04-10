<?php
if(isset($_POST["submitregistration"]))
{
	require 'dbhandler.php';
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$passwordcheck = $_POST["passwordcheck"];
	
	if(empty($username) || empty($password) || empty($passwordcheck)){
		echo "Field empty!";
		exit();
	}

	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		echo "Invalid email!";
		exit();
	}

	if(!preg_match("/^[a-zA-Z0-9]*$/", $username))
	{
		echo "Username must be alphanumerical!";
		exit();
	}

	if($passwordcheck !== $password)
	{
		echo "Passwords don't match!";
		exit();
	}

	$sql = "SELECT username FROM users WHERE username=?";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	$resultcheck = mysqli_stmt_num_rows($stmt);
	if($resultcheck > 0)
	{
		echo "Username taken!";
		exit();
	}

	$sql = "INSERT INTO users (User, Password, email) VALUES (?, ?, ?)";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql))
	{
		header("Location: ../html/registration.html");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);
	mysqli_execute($stmt);
	echo "Account created! ;)";
}
else
{
	header("Location: ../html/index.html");
}