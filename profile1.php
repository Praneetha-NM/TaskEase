<?php
session_start(); // Start the session to access session variables

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "Praneetha";
$dbname = "TaskEase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $role = $conn->real_escape_string($_POST['role']);
    $want_notification = isset($_POST['not']) ? 1 : 0; // Convert checkbox value to boolean

    // Store data in session variables
    $_SESSION['role'] = $role;
    $_SESSION['want_notification'] = $want_notification;

    // Redirect to the next HTML file or perform further actions
    header("Location: profile2.html");
    exit(); // Ensure that script execution stops after redirection
}

// Close connection
$conn->close();
?>
