<?php 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {		
	
	require('includes/mysqli_connect.php');
	
	// Check the login:
	$e = mysqli_real_escape_string($dbc, $_POST['email']);
	$p = mysqli_real_escape_string($dbc, $_POST['password']);
	$query = "SELECT * FROM users WHERE email='$e' AND password='$p' LIMIT 1";
	$run = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($run, MYSQLI_ASSOC);
	mysqli_close($dbc);
	
	if ($run) {
		// Set the session data - using session information in other pages:
		session_start();
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_image'] = $row['user_image'];
		
		echo "<script>console.log('session user id in login: ".$_SESSION['user_id']."')</script>";
		echo "<script>console.log('session user id in login: ".$_SESSION['user_image']."')</script>";
	}
	else { // Unsuccessful!
		// Assign $data to $errors for error reporting
		$errors = $data;
	}
} 
?>