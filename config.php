<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'to_do';

$mysqli_connection =new MySQLi($host, $user, $password, $database) ;
if ($mysqli_connection->connect_error) {
    echo "Error:".$mysqli_connection->connect_error;
}
?>