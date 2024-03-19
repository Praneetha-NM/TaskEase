<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "TaskEase";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
