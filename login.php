<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
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
    $_SESSION['username'] = $username;

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
            // Password matches, set username in session and redirect to front page
            $_SESSION['username'] = $username;
            header("Location: front_pagee.php");
            exit;
        } else {
            // Password doesn't match, set error message
            $_SESSION['error'] = "Wrong Username or Password";
        }
    } else {
        // Username not found, set error message
        $_SESSION['error'] = "Wrong Username or Password";
    }

    // Close statement and result
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <script>
    <?php
    if (isset($_SESSION['error'])) {
        // Display error message as an alert box
        echo 'alert("' . $_SESSION['error'] . '");';
        unset($_SESSION['error']);
    }
    ?>
    window.location.href = "Login.html";
    </script>
</body>
</html>
