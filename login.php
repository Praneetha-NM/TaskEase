<?php
<<<<<<< Updated upstream
=======
session_start();

>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
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

=======
            $_SESSION['username'] = $username;
        } else {
            // Password doesn't match, set error message
            $_SESSION['error'] = "Wrong Username or Password";
        }
    } else {
        // Username not found, set error message
        $_SESSION['error'] = "Wrong Username or Password";
    }
>>>>>>> Stashed changes
    // Close statement and result
    $stmt->close();
}

// Close connection
$conn->close();
<<<<<<< Updated upstream
header("Location: login.html");
exit;
?>
=======

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php
    if (isset($_SESSION['error'])) {
        echo '<script>
                alert("' . $_SESSION['error'] . '");
                window.location.href = "login.html";
              </script>';
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['username'])) {
        echo '<script>
                alert("Welcome ' . $_SESSION['username'] . '");
                window.location.href = "front_page.html";
              </script>';
        unset($_SESSION['username']);
    }
    ?>
</body>
</html>
>>>>>>> Stashed changes
