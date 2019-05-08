<?php # Script 12.4 - loggedin.php
// The user is redirected here from login.php.

session_start();
// If no cookie is present, redirect the user:
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ('includes/functions.php');
	redirect_user();	

}

// Set the page title and include the HTML header:
include('includes/functions.php');
$pageTitle = "Welcome";

include('includes/header.php');
include('includes/mysqli_connect.php');

$query = "SELECT user_id, CONCAT(first_name,' ', last_name)AS name, email FROM users WHERE user_id = ".$_SESSION['user_id'];

$run = mysqli_query($dbc, $query);

if (mysqli_num_rows($run) == 1){
	$row = mysqli_fetch_array($run, MYSQLI_ASSOC);
	// Print a customized message:

}else{
	echo "Error!";
}
mysqli_close($dbc);

include ('includes/footer.php');
?>