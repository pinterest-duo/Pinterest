<?php 
require('includes/mysqli_connect.php');
$url = $_POST['pin_url'];
// $pin = $_POST['pin_id'];
$board = $_POST['board_id'];
$userid = 1;

echo "pin url: $url <br> boardid: $board <br> user: $userid <br>";

$query = "INSERT INTO pins(pin_url, board_id, user_id) VALUES('$url','$board','$userid');";
$run = mysqli_query($dbc, $query);
if(mysqli_affected_rows($dbc) == 1){
    echo "<p>User has been edited.</p>";
}
else{
    echo "erro".mysqli_error($dbc);
}
mysqli_close($dbc);
?>