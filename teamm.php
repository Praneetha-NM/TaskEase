<?php
// Database connection parameters
session_start();
// Establish database connection
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$database = "TaskEase";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$teamName = $_POST['teamname'];
$descriptionn = $_POST['des'];
$priority = $_POST['priority'];
$category = $_POST['category'];
$dueDate= $_POST['date'];
$username=$_SESSION['username'];

// Prepare SQL statement
$sql = "INSERT INTO team (username, team_name, description, due_date, priority, category) VALUES (?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssis", $username, $teamName, $descriptionn, $dueDate, $priority, $category);
if ($stmt->execute()) {
    // Redirect back to front_page.html after adding the task
    header("Location: team.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// Close statement and connection
$stmt->close();
$conn->close();
?>
