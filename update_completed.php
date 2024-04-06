<?php
session_start(); // Start the session
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'completed_tasks' array is set and not empty
    if (isset($_POST['completed_tasks']) && !empty($_POST['completed_tasks'])) {
        // Check if the session variable 'task_entries' is set
        if (isset($_SESSION['task_entries'])) {
            // Retrieve the task entries from the session variable
            $task_entries = $_SESSION['task_entries'];

            // Loop through each checked checkbox
            foreach ($_POST['completed_tasks'] as $index) {
                // Sanitize input data (index of the task)
                $index = filter_var($index, FILTER_SANITIZE_NUMBER_INT);

                // Check if the index is valid and within the range of task_entries
                if (isset($task_entries[$index])) {
                    // Retrieve the task entry from the task_entries array using the index
                    $task = $task_entries[$index];

                    // Retrieve the task name
                    $task_name = $task["task_name"];
                    $username = $_SESSION['username'];

                    // Update the 'completed' attribute in the task table
                    $sql_update = "UPDATE task SET completed = TRUE WHERE task_name = ? AND username = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("ss", $task_name, $username);
                    $stmt_update->execute();
                    
                    // Insert the completed task into the completed_task table
                    $sql_insert = "INSERT INTO completed_task (username, task_name, description, due_date, priority, category, completed)
                                   SELECT username, task_name, description, due_date, priority, category, completed
                                   FROM task
                                   WHERE task_name = ? AND username = ?";
                    $stmt_insert = $conn->prepare($sql_insert);
                    $stmt_insert->bind_param("ss", $task_name, $username);
                    $stmt_insert->execute();

                    // Delete the completed task entry from the task table
                    $sql_delete = "DELETE FROM task WHERE task_name = ? AND username = ?";
                    $stmt_delete = $conn->prepare($sql_delete);
                    $stmt_delete->bind_param("ss", $task_name, $username);
                    $stmt_delete->execute();

                    // Debugging: Output the updated task name
                    echo "Task '$task_name' marked as completed and removed from the task list.<br>";
                } else {
                    echo "Invalid index: $index<br>";
                }
            }
        } else {
            echo "No task entries found in the session.";
        }
    } else {
        echo "No tasks selected.";
    }
} else {
    echo "No form submission detected.";
}
header("Location: front_pagee.php");
exit;
// Close connection
$conn->close();
?>
