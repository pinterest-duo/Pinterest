<?php
//This script performs an INSERT query to add a record to the users table
echo "<H1>SIGNUP PAGE PHP</H1>";
// Check for form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	require('includes/mysqli_connect.php');// Connect to the db
	
	$errors = array(); //Intialize an array that will store error messages for the user
	
	
	//Check for data entered into the 'email' form field
	if(empty($_POST['email'])){
		$errors[] = "You forgot to enter your email.";
	}else{
		$e = mysqli_real_escape_string($dbc, $_POST['email']);
	}
	
	//Check for data entered into the 'password' form field
	if(empty($_POST['password'])){
		$errors[] = "You forgot to enter your password.";
	}else{
		$p = mysqli_real_escape_string($dbc, $_POST['password']);
	}

	//Check for data entered into the 'age' form field
	if(empty($_POST['age'])){
		$errors[] = "You forgot to enter your age.";
	}else{
		$a = mysqli_real_escape_string($dbc, $_POST['age']);
	}


	if(empty($errors)){
		// Grab the "First Name" from the first half of the email
		$name = "";
		for($i = 0; $i < strlen($e); $i++){
			if($e[$i] == "@"){
				break;
			}
			$name .= $e[$i];
		}

		$query = "INSERT INTO users (username, email, password, age, first_name, gender, user_language, country, user_location, user_image)
		VALUES('$name','$e', '$p','$a', '$name', 'na', 'English', 'United States', 'New York', 'https://wallpaperbro.com/img/84230.jpg')";
		
		$run = mysqli_query($dbc, $query); //Run the query

		if($run){//If the query ran successfully
			echo "<h1>Thank you!</h1> <p>You have been registered</p>";
			session_start();
		}else{ //If the query did not run successfully
			echo "<h1>Error!<h1> <p>You could not be registered. Please try again.</p>";
			
			//Print a debugging message
			echo "<p>".mysqli_error($dbc)."</p>";
		}

		mysqli_close($dbc); //Close the db connection
		exit(); //Terminate the execution of the script
	}else{		
		echo "<h2>Error!</h2>";
		echo "<p>The following error(s) have occured:<br />";
		foreach ($errors as $error){
			echo " - $error <br />";
		}
		echo "Please try again.</p>";
	}
	mysqli_close($dbc);
}
?>