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
    $first_name = $conn->real_escape_string($_POST['fname']);
    $last_name = $conn->real_escape_string($_POST['lname']);

    // File upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile-image"]["name"]);
    move_uploaded_file($_FILES["profile-image"]["tmp_name"], $target_file);
    $profile_picture = file_get_contents($target_file);

    // Store data in session variables
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['profile_picture'] = $profile_picture;

    // Redirect to the next HTML file or perform further actions
    header("Location: profile1.html");
    exit(); // Ensure that script execution stops after redirection
}

// Close connection
$conn->close();
?>
