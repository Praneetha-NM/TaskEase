<?php
// Database connection
session_start();
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
$sql = "SELECT * FROM task WHERE username = ? ORDER BY due_date";
$stmt = $conn->prepare($sql);

// Bind parameters and execute the statement
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();

// Get result set
$result = $stmt->get_result();

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Upcoming Page</title>
        <link rel="stylesheet" href="homestyle.css">
    </head>
    <body style="background-color:#1b1b1b;overflow-x:auto;overflow-y:hidden;">
        <div class="front_page" style="display:flex;justify-content:space-between;">
            <div class="sidebar" style="background-color:#1b1b1b;width:300px;height:100%;">
            <br><br><br>
                <div class="bar">
                <a href="Inbox.php" style="text-decoration:none;">
                    <button style="display:flex;">
                        <img src="Add_task.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">
                        <p style="margin-top:0px;font-size:15px;"> Add task </p>
                    </button>
                </a>
                <br>
                </div>
                <div class="bar">
                    <a href="Search.html" style="text-decoration:none;">
                        <button style="display:flex;">
                            <img src="Search.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">
                            <p style="margin-top:0px;font-size:15px;"> Search </p>
                        </button>
                    </a>
                </div>
                <div class="bar">
                    <a href="Inbox.php" style="text-decoration:none;">
                        <button style="display:flex;">
                            <img src="Inbox.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">
                            <p style="margin-top:0px;font-size:15px;"> Inbox </p>
                        </button>
                    </a>
                </div>
                <div class="bar">
                    <a href="front_pagee.php" style="text-decoration:none;">
                        <button style="display:flex;">
                            <img src="Today.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">
                            <p style="margin-top:0px;font-size:15px;"> Today </p>
                        </button>
                    </a>
                </div>
                <div class="bar">
                    <a href="Upcoming.php" style="text-decoration:none;">
                        <button style="display:flex;">
                            <img src="Upcoming.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">
                            <p style="margin-top:0px;font-size:15px;"> Upcoming </p>
                        </button>
                    </a>
                </div>
                <div class="bar">
                    <a href="Filters.html" style="text-decoration:none;">
                        <button style="display:flex;">
                            <img src="Filter.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">
                            <p style="margin-top:0px;font-size:15px;"> Filters  </p>
                        </button>
                    </a>
                </div>
                <br><br>
                <div class="Projects" style="display:flex;">
                    <button style="font-size:17px;width:150px;text-align:left;margin-top:0px;font-weight:lighter;">My Projects</button>
                        <button style="width:25px;height:25px;margin-top:5px;font-size:15px;">+</button>
                        <button class="trans" style="width:25px;height:25px;margin-top:5px;font-size:15px;">&gt</button>
                </div>
                <div class="bar" style="margin-top:330px;">
                    <a href="team.php" style="text-decoration:none;">
                        <button style="display:flex;">
                            <img src="Add_task.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">
                            <p style="margin-top:0px;font-size:15px;"> Add a Team </p>
                        </button>
                    </a>
                    <br>
                </div>
                </div>
            <div class="main" style="background-color:#000;width:80%;height:750px;flex-grow: 1;">
                <h2 style="font-family:Tahoma;margin-top:90px;margin-left:90px;color:#ceff1a;">Upcoming</h2>
                
                <?php
                if ($result && $result->num_rows > 0) {
                    echo '<div id="task-table" style="background-color:#000;border-radius:10px;color:#fff;width:1000px;margin-top:60px;">';
                
                    // Initialize variable to store previous date
                    $prev_date = null;
                
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $due_date = date("M d", strtotime($row["due_date"])); // Format the due date

                        // Check if the date has changed
                        if ($due_date != $prev_date) {
                        // Output heading for the new date
                            echo "<h3 style='margin-left:90px;color:#ceff1a;'>$due_date</h3>";
                            $prev_date = $due_date;
                        }
                
                        // Output task details
                        echo '<table style="margin-left:90px;">';
                        echo '<tr>';
                        echo '<td style="width:700px;"><input type="checkbox" style="background-color:#1b1b1b;"> <span style="font-family:Arial;font-size:15px;font-weight:lighter;margin-left:30px;">' . $row["task_name"] . '</span>';
                        echo '<p style="font-family:Arial;font-size:12px;font-weight:lighter;">' . $row["description"] . '</p>';
                        echo '<p style="font-family:Arial;font-size:12px;font-weight:lighter;color:lightgreen;">' . $row["due_date"] . '</p>';
                        echo '<p style="margin-left:700px;font-family:Arial;font-size:12px;font-weight:lighter;color:lightgrey;">' . $row["category"] . '</p></td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '<hr style="border:.2px solid #666666;margin-left:90px;width:820px;">';
                    }
                
                    echo '</div>';
                    echo '<div id="add_taskk" class="bar" style="margin-left:90px;margin-top:60px;">';
                    echo '<button onclick="toggleTaskForm()" style="display:flex;background-color:#000;border:none;">';
                    echo '<img src="Add_task.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">';
                    echo '<p style="margin-top:0px;font-size:15px;color:#fff;"> Add task </p>';
                    echo '</button>';
                    echo '</div>';
                } else {
                    echo '<div id="add_task" class="bar" style="margin-left:90px;margin-top:60px;">';
                    echo '<button onclick="toggleTaskForm()" style="display:flex;background-color:#000;border:none;">';
                    echo '<img src="Add_task.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">';
                    echo '<p style="margin-top:0px;font-size:15px;color:#fff;"> Add task </p>';
                    echo '</button>';
                    echo '</div>';
                    echo '<h3 style="color:#ceff1a;font-family:Arial;margin-left:450px;">No Tasks Assigned</h3>';
                    echo '<img id="fp-image" style="margin-top:30px;margin-left:400px;width:300px;height:300px;" src="todaymain.png">';
                    echo '<p id="task-info" style="margin-left:380px;font-weight:bold;color:#fff;font-family:Tahoma;">What do you need to get done today?</p>';
                    echo '<p id="task-instructions" style="margin-right:0px;color:lightgrey;text-align:center;font-family:Tahoma;font-size:15px;">By default, tasks added here will be due <br>today. Click + to add a task.</p>';
                }
            
                ?>
                <div id="task-form" style="display:none;margin-left:100px;margin-top:100px;">
                        <form action="Upcomingg.php" method="POST" onsubmit="return validate()">   
                            <table style="border:2px solid #333333;border-radius:10px;color:#fff;width:700px;background-color:#1b1b1b;">
                                <tr>
                                    <td>
                                        <input name="taskname" style="width:700px;font-size:15px;padding-left: 10px;padding-top:10px;padding-bottom:10px;border:none;background-color:#1b1b1b;border-radius: 10px;color:#fff;"type="text" id="taskname" name="taskname" placeholder="Task name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="des" style="width:700px;font-size:10px;padding-left: 10px;padding-top:10px;padding-bottom:10px;border:none;background-color:#1b1b1b;border-radius: 10px;color:#fff;"type="text" id="des" name="des" placeholder="Description">
                                    </td>
                                <tr>
                                    <td>
                                        <label style="margin-left:10px;font-family:Arial;color:#888888;font-size:14px;margin-bottom:-15px;">Due Date: </label>
                                        <input name="date" style="margin-left:60px;font-size:10px;padding-left: 10px;padding-right: 10px;padding-top:10px;padding-bottom:10px;border:1px solid #333333;background-color:#000;border-radius: 10px;color:#fff;" type="text" placeholder="yyyy-mm-dd" id="date" required>
                                        <span id="daterr" style="color:red;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><hr style="border:.5px solid #333333;"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="priority" style="font-size:15px;margin-left:10px;margin-bottom:10px;padding-top:10px;padding-bottom:10px;border:none;background-color:#000;border-radius: 10px;color:#fff;">
                                            <option value="5">Priority</option>
                                            <option value="1">Priority 1</option>
                                            <option value="2">Priority 2</option>
                                            <option value="3">Priority 3</option>
                                            <option value="4">Priority 4</option>
                                        </select>
                                        <span style="margin-left:25px;"></span>
                                        <select name="category" style="font-size:15px;margin-left:10px;margin-bottom:10px;padding-top:10px;padding-bottom:10px;border:none;background-color:#000;border-radius: 10px;color:#fff;">
                                            <option value="Inbox">Inbox</option>
                                            <option value="Project">Project</option>
                                        </select>
                                        <span style="margin-left:345px;"></span>
                                        <button type="button" style="border-radius:5px;background-color:#888888;border:none;height:30px;color:#fff;" onclick="cancelTask()">Cancel</button>
                                        <input type="submit" value="Add Task" style="margin-left:10px;border-radius:5px;background-color:#ceff1a;width:70px;border:none;height:30px;"onclick="addTask()">
                                    </td>
                                </tr>
                        </table>
                        </form>
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    </div>
                    <!-- End of task form -->
                    <br><br><br><br><br><br><br>
                
            </div>
        
            <!-- JavaScript to toggle task form visibility -->
            <script>
                function validate(){
                    var dateInput = document.getElementById('date').value;
                    var msg=document.getElementById('daterr');
                    var currentDate = new Date();
                    var inputDate = new Date(dateInput);
                    var regex = /^\d{4}-\d{2}-\d{2}$/;
                    msg.textContent="";
                    if (!regex.test(dateInput) || !inputDate ){
                        msg.textContent="Wrong Date Format";
                        return false;
                    }
                    if(inputDate < currentDate && inputDate.toDateString() != currentDate.toDateString()) {
                        msg.textContent="Enter present date or upcoming Dates"
                        return false; 
                    }
                    return true;
                }
                function toggleTaskForm() {
                    var buttona = document.getElementById('add_task');
                    var fpImage = document.getElementById('fp-image');
                    var taskInfo = document.getElementById('task-info');
                    var taskInstructions = document.getElementById('task-instructions');
                    var taskForm = document.getElementById('task-form');
        
                    if (taskForm.style.display === 'none') {
                        taskForm.style.display = 'block';
                        fpImage.style.display = 'none';
                        buttona.style.display = 'none';
                        taskInfo.style.display = 'none';
                        taskInstructions.style.display = 'none';
                    } else {
                        taskForm.style.display = 'none';
                        fpImage.style.display = 'block';
                        buttona.style.display = 'block';
                        taskInfo.style.display = 'block';
                        taskInstructions.style.display = 'block';
                    }
                }
        
                function cancelTask() {
                    toggleTaskForm(); // Hide the form
                    // Clear the form fields (if needed)
                    document.querySelector('#task-form form').reset();
                }
        
                function addTask() {
                    // Add functionality to add task here
                    // You can retrieve form values using document.querySelector or other methods
                    // After adding the task, you might want to hide the form and clear the fields
                    
                }
                </script>
            </div>
        </div>
    </body>
</html>
