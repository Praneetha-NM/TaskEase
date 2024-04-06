<?php
session_start(); // Start the session to access session variables

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TaskEase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $team_name = $conn->real_escape_string($_POST['teamname']);

    // Store data in session variables
    $_SESSION['team_name'] = $team_name;

    // Redirect to the next HTML file or perform further actions
    header("Location: profile3.html");
    exit(); // Ensure that script execution stops after redirection
}

// Close connection
$conn->close();
?>
