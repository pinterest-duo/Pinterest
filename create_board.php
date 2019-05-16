<?php 
require('includes/mysqli_connect.php');
// Userid must be populated differently
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
$userid = $_SESSION['user_id'];
$url = $_POST['pin_url'];
$board_name = $_POST['board_name'];
$blurb = $_POST['pin_desc'];
$is_secret_board = $_POST['is_secret_board'];

echo "
<h1>Form Info</h1>
pin url: $url <br> 
boardName: $board_name <br> 
is_secret_board: $is_secret_board <br>
user: $userid <br>";

echo "<h1>Board Query</h1>";
// Change the query depending on whether or not the board is secret
if($is_secret_board == NULL || $is_secret_board == '' || $is_secret_board == ' '){
    echo "secret board null<br>";
    $query = "INSERT INTO boards(board_name, cover_pin_url, secret_board, user_id) VALUES('$board_name','$url', 'NO', '$userid');";
}
else{
    echo "secret board NOT null<br>";
    $query = "INSERT INTO boards(board_name, cover_pin_url, secret_board, user_id) VALUES('$board_name','$url', 'YES', '$userid');";
}
// Create the Board
$run = mysqli_query($dbc, $query);
if(mysqli_affected_rows($dbc) == 1){
    echo "<p>Board has been added.</p>";
}
else{
    echo "error".mysqli_error($dbc);
}


// Get the board id for the board we just created
// $query = "SELECT board_id FROM boards WHERE board_name = '$board_name';";
$query = "SELECT board_id FROM boards ORDER BY board_date DESC LIMIT 1;";
$run = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($run, MYSQLI_ASSOC);
echo "board_id run contains: ".$row['board_id'];
$pinBoard = $row['board_id'];

// ERROR: WON'T CREATE THE PIN BECAUSE THE BOARD ID IS INVALID

// Create the Pin
if($blurb == NULL){
    $query = "INSERT INTO pins(pin_url, board_id, user_id) VALUES('$url','$pinBoard','$userid');";
}
else{
    $query = "INSERT INTO pins(pin_url, blurb, board_id, user_id) VALUES('$url', '$blurb','$pinBoard','$userid');";
}
$run = mysqli_query($dbc, $query);

echo "<h1>Pin Query</h1>";
if(mysqli_affected_rows($dbc) == 1){
    echo "<p>User has been edited.</p>";
}
else{
    echo "error".mysqli_error($dbc);
}

mysqli_close($dbc);

?>