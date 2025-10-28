<?php 
$servername = "localhost";
$username = "root";
$pass = "";
$db = "form_submission";

$conn = mysqli_connect($servername, $username, $pass, $db);

if ($conn) {
    echo "db connected";
}else{
    echo "not connected";
}

?>