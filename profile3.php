<?php
session_start(); // Start the session to access session variables
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    $plan = $conn->real_escape_string($_POST['plan']);
    

    // Retrieve username from session
    $username = $_SESSION['username'];

    // Fetch user_id from users table
    $sql_user = "SELECT id FROM users WHERE username = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("s", $username);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    
    if ($result_user->num_rows > 0) {
        $row_user = $result_user->fetch_assoc();
        $user_id = $row_user['id'];
          // Retrieve data from session variables
        $first_name = $_SESSION['first_name'];
        $last_name = $_SESSION['last_name'];
        $profile_picture = $_SESSION['profile_picture'];
        $role = $_SESSION['role'];
        $want_notification = isset($_SESSION['want_notification']) ? $_SESSION['want_notification'] : null;
        $team_name = isset($_SESSION['team_name']) ? $_SESSION['team_name'] : null;

        // Insert data into the database
        $sql = "INSERT INTO details (user_id, first_name, last_name, profile_picture, role, want_notification, team_name, plan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issbssss", $user_id, $first_name, $last_name, $profile_picture, $role, $want_notification, $team_name, $plan);
        $stmt->execute();
        $stmt->close();

        // Redirect to the desired page
        header("Location: front_pagee.php"); // Redirect to a success page or any other page
        exit(); // Ensure that script execution stops after redirection
    } else {
        echo "Error: User not found";
    }
}
$conn->close();
?>
