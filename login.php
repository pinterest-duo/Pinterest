<?php 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// For processing the login:
	require_once ('includes/functions.php');
	
	// Need the database connection:
	require ('includes/mysqli_connect.php');
		
	// Check the login:

	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['password']);
	
	if ($check) { // OK!
		// Set the session data - using session information in other pages:
		session_start();
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['email'] = $data['email'];
		
		// Redirect:
		redirect_user('loggedin.php');	
	}
	else { // Unsuccessful!

		// Assign $data to $errors for error reporting
		// in the login_page.inc.php file.
		$errors = $data;
	}
		
	mysqli_close($dbc); // Close the database connection.
} 

include ('login_form.php');
?>