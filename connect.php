<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'task'; 


$con= mysqli_connect($hostname, $username, $password, $database); // mysqli_connect remember this because it is a sql function to check the connection 


if (!$con) {
    die('Connection failed: ' . mysqli_connect_error()); // die is also a sql function it will execute when the connection fails
}
 echo 'Connected successfully';//if the connection is successful then we will get this echo statement as output

?>
