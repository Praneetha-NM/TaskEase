<?php
// Start session
session_start();
$servername = "localhost";
$username = "root";
$password = "Praneetha";
$database = "TaskEase";

$db = new mysqli('localhost', 'username', 'password', 'TaskEase');

// Check database connection
if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Check which step the form is in
    $step = 1;

    // Retrieve user ID from session (assuming it's set during login or registration)
    $user_id = $_SESSION['user_id'];

    // Insert data into database based on the current step
    switch ($step) {
        case 1:
            // Step 1: Insert first name, last name, and profile picture
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            // Handle profile picture upload and store its binary data in $profile_picture variable

            // Prepare and execute SQL query
            $insertQuery = "INSERT INTO details (user_id, first_name, last_name, profile_picture) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($insertQuery);
            $stmt->bind_param("isss", $user_id, $first_name, $last_name, $profile_picture);
            $stmt->execute();
            break;

        case 2:
            // Step 2: Insert role and want_notification
            $role = $_POST['role'];
            $want_notification = $_POST['want_notification'];

            // Prepare and execute SQL query
            $updateQuery = "UPDATE details SET role = ?, want_notification = ? WHERE user_id = ?";
            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param("ssi", $role, $want_notification, $user_id);
            $stmt->execute();
            break;

        case 3:
            // Step 3: Insert team name
            $team_name = $_POST['team_name'];

            // Prepare and execute SQL query
            $updateQuery = "UPDATE details SET team_name = ? WHERE user_id = ?";
            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param("si", $team_name, $user_id);
            $stmt->execute();
            break;

        case 4:
            // Step 4: Insert plan
            $plan = $_POST['plan'];

            // Prepare and execute SQL query
            $updateQuery = "UPDATE details SET plan = ? WHERE user_id = ?";
            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param("si", $plan, $user_id);
            $stmt->execute();
            break;

        default:
            // Invalid step
            break;
    }

    // Redirect to next step
    $nextStep = $step + 1;
    header("Location: profile{$nextStep}.html");
    exit();
}

// Close database connection
$db->close();
?>
