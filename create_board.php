<?php 
require('includes/mysqli_connect.php');
// Userid must be populated differently
$userid = 1;
$url = $_POST['pin_url'];
$board_name = $_POST['board_name'];
$is_secret_board = $_POST['is_secret_board'];

echo "
pin url: $url <br> 
boardid: $board_name <br> 
is_secret_board: $is_secret_board <br>
user: $userid <br>";

// Create the Board
$query = "INSERT INTO boards(board_name, cover_pin_url, user_id) VALUES('$board_name', '$url','$userid');";
$run = mysqli_query($dbc, $query);
if(mysqli_affected_rows($dbc) == 1){
    echo "<p>Board has been added.</p>";
}
else{
    echo "error".mysqli_error($dbc);
}

$query = "SELECT board_id FROM boards WHERE board_name = $board_name;";
$run = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($run, MYSQLI_ASSOC);
$board = $row['board_id'];

echo "
boardid: $board <br> 
";


// Create the Pin
$query = "INSERT INTO pins(pin_url, board_id, user_id) VALUES('$url','$board','$userid');";
$run = mysqli_query($dbc, $query);
if(mysqli_affected_rows($dbc) == 1){
    echo "<p>User has been edited.</p>";
}
else{
    echo "error".mysqli_error($dbc);
}

mysqli_close($dbc);

?>