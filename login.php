<?php

	session_start();
	
	if ($_GET["logout"]==1 AND $_SESSION['id']) {
	
	session_destroy();
	$message = "You have been succesfully logged out.";
	
	}

	ini_set('display_errors', 'On');
	
	include("connection.php");
	
	// Sign Up
	if ($_POST['submit']=="Sign Up") {
		
		//validate Data
		if (!$_POST['first']) $error.="<br/>Please enter your First Name.";
		
		if (!$_POST['last']) $error.="<br/>Please enter your Last Name. ";
		
		if (!$_POST['email']) $error.="<br />Please enter your email.";
			else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $error.="<br /> Please enter a valid email addreess.";
			
		if (!$_POST['password']) $error.="<br /> Please enter a password.";
			else {
			
				if (strlen($_POST['password'])<8) $error.="<br />Please enter a password with at least 8 characters";
				if (!preg_match('`[A-Z]`', $_POST['password'])) $error.="<br />Please include at least one capital letter in your password.";	
			
			}
		
		if ($error) $error = "PLEASE CORRECT THE FOLLOWING:" . $error;
		else {
		
		$query="SELECT * FROM `users` WHERE email='".mysqli_real_escape_string($conn, $_POST['email'])."'";
		
		$result = mysqli_query($conn, $query);
		
		$results = mysqli_num_rows($result);
		
			if ($results) $error = "This email already exists in the system. Are you trying to login?";
			else {
				
				//Create new user account
				$first = mysqli_real_escape_string($conn, $_POST['first']);
				$last = mysqli_real_escape_string($conn, $_POST['last']);
				$email = mysqli_real_escape_string($conn, $_POST['email']);
				$password = md5(md5($_POST['email']).$_POST['password']);
			
				$query = "INSERT INTO `users` ( `first`, `last`, `email`, `password`) VALUES('$first', '$last', '$email', '$password')";
				
				mysqli_query($conn, $query);
				
				$message = "Your user account has been created! Please log in at the top of the page.";
				
				$_SESSION['id']=mysqli_insert_id($conn);	
			
			}
		}
	}
	
	//Log In
	if ($_POST['submit']=="Log In") {
	
		$query = "SELECT * FROM users WHERE email='".mysqli_real_escape_string($conn, $_POST['loginemail'])."' AND
						password='".md5(md5($_POST['loginemail']).$_POST['loginpassword'])."' LIMIT 1";
						
		$result = mysqli_query($conn, $query);
		
		$row = mysqli_fetch_array($result);
		
		if ($row) {
		
			$_SESSION['id']=$row['id'];
			
			// Redirect to logged in page.
			header("Location:main.php");
		
		} else {
		
			$error = "We could not find a user with that email and password combination.";
		
		}
	
	}
	

?>