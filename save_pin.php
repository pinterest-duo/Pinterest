<?php 
require('mysqli_connect.php');
$url = $_POST['pin_url'];
// $pin = $_POST['pin_id'];
$board = $_POST['board_id'];
$userid = 1;

$query = "INSERT INTO pins(pin_url, board_id, user_id) VALUES('$url','$board','$userid');";


$run = mysqli_query($dbc, $query);

if (mysqli_affected_rows($dbc) == 1){
}

mysqli_close($dbc);
?>