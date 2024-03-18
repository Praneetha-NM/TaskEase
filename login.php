<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "Praneetha";
$database = "TaskEase";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user inputs
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle form submission for user login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $username = sanitize_input($_POST["username"]);
    $password = sanitize_input($_POST["password"]);

    // Prepare SQL statement to retrieve hashed password for the provided username
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Username found, verify password
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        if (password_verify($password, $hashed_password)) {
            // Password matches, redirect to front page with welcome message
            header("Location: front_page.html");
            exit;
        } else {
            // Password doesn't match, display error message
            echo '<script>alert("Wrong Username or Password");</script>';
        }
    } else {
        // Username not found, display error message
        echo '<script>alert("Wrong Username or Password");</script>';
    }

    // Close statement and result
    $stmt->close();
}

// Close connection
$conn->close();
header("Location: login.html");
exit;
?>
