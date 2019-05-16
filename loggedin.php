<?php # Script 12.4 - loggedin.php
session_start();
// If no cookie is present, redirect the user:
echo "you've tried to login";
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ('includes/functions.php');
	redirect_user();	

}

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