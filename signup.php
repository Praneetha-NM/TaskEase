<?php

session_start();
// Establish database connection
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

// Initialize message variable
$message = "";

// Handle form submission for user signup
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $username = sanitize_input($_POST["username"]);
    $password = sanitize_input($_POST["password"]);
    $_SESSION['username'] = $username;
    // Check if the username already exists in the database
    $check_stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Username already exists, display alert message and redirect to login page
        $message = "Username already exists. Please choose a different username.";
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert user data into the database
        
        $insert_stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

        $insert_stmt->bind_param("ss", $username, $hashed_password);


        // Execute the prepared statement
        if ($insert_stmt->execute()) {
            // Signup successful, redirect to login page
            header("Location: profile.html");
            exit; // Ensure that script execution stops after redirection
        } else {

            // Signup failed
            $message = "Error: " . $insert_stmt->error;
        }

        // Close insert statement
        $insert_stmt->close();
    }

    // Close check statement
    $check_stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <script>
    // Display message as an alert box
    alert("<?php echo $message; ?>");

    // Redirect to the login page if the username already exists
    <?php if ($message == "Username already exists. Please choose a different username.") : ?>
    window.location.href = "Signup.html";
    <?php endif; ?>
    </script>
</body>
</html>