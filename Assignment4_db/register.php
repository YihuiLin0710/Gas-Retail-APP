<?php
	session_start();
	$_SESSION['username'] = $_POST['user'];
    //$_SESSION['password'] = $_POST['password'];
	$plaintext_password = $_POST['password'];
	$hash = password_hash($plaintext_password, PASSWORD_DEFAULT);
	$_SESSION['hash'] = $hash;
	
    
	// Database connection
	$conn = new mysqli("localhost", "root","","profile");
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into customer_profile(username) values(?)");
		$stmt->bind_param("s", $_SESSION['username']);
		$execval = $stmt->execute();
		$stmt = $conn->prepare("insert into usercredentials(username, password) values(?, ?)");
		$stmt->bind_param("ss", $_SESSION['username'], $_SESSION['hash']);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
        header("location:profile.html");
		$stmt->close();
		$conn->close();
	}
?>