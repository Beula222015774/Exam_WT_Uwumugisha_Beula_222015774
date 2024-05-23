<?php
// Connection details
$host = "localhost";
$user = "david";
$pass = "david123";
$database = "wedding_planning";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    echo "Connected successfully";
}
?>
