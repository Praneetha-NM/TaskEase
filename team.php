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
$sql = "SELECT * FROM team WHERE username = ?";
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
        <title>Add Team page</title>
        <link rel="stylesheet" href="homestyle.css">
    </head>
    <body style="background-color:#1b1b1b;overflow-x:auto;overflow-y:hidden;">
        <div class="front_page" style="display:flex;justify-content:space-between;">
            <div class="sidebar" style="background-color:#1b1b1b;width:300px;height:100%;">
            <br><br><br>
                <div class="bar">
                <a href="Inbox.php" style="text-decoration:none;">
                    <button  style="display:flex;">
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
                    <a href="Filters.php" style="text-decoration:none;">
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
            <div class="main" style="background-color:#000;width:80%;height:750px;flex-grow: 1">
                <h2 style="font-family:Tahoma;margin-top:90px;margin-left:90px;color:#ceff1a;">Teams</h2>
                
                <?php
                if ($result && $result->num_rows > 0) {
                    
                    
                    echo '<div id="task-table" style="background-color:#000;border-radius:10px;color:#fff;width:1000px;margin-top:60px;">';
                    echo '<table style="margin-left:90px;">';

                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td style="width:700px;"><input type="checkbox" style="background-color:#1b1b1b;"> <span style="font-family:Arial;font-size:15px;font-weight:lighter;margin-left:30px;">' . $row["team_name"] . '</span>';
                        echo '<p style="font-family:Arial;font-size:12px;font-weight:lighter;">' . $row["description"] . '</p>';
                        echo '</tr>';
                        echo '<tr><td style="width:820px;"><hr style="border:.2px solid #666666;></td></tr>';
                    }

                    echo '</table>';
                    echo '</div>';
                    echo '<div id="add_taskk" class="bar" style="margin-left:90px;margin-top:60px;">';
                    echo '<button onclick="toggleTaskForm()" style="display:flex;background-color:#000;border:none;">';
                    echo '<img src="Add_task.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">';
                    echo '<p style="margin-top:0px;font-size:15px;color:#fff;"> Add Team </p>';
                    echo '</button>';
                    echo '</div>';
                } else {
                    echo '<div id="add_task" class="bar" style="margin-left:90px;margin-top:60px;">';
                    echo '<button onclick="toggleTaskForm()" style="display:flex;background-color:#000;border:none;">';
                    echo '<img src="Add_task.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">';
                    echo '<p style="margin-top:0px;font-size:15px;color:#fff;"> Add Team </p>';
                    echo '</button>';
                    echo '</div>';
                    echo '<img id="fp-image" style="margin-top:30px;margin-left:400px;width:300px;height:300px;" src="team.png">';
                    echo '<p id="task-info" style="margin-left:340px;font-weight:bold;color:#fff;font-family:Tahoma;">"Unveiling New Horizons: Your Team, Our Journey"</p>';
                    echo '<p id="task-instructions" style="margin-right:0px;color:lightgrey;text-align:center;font-family:Tahoma;font-size:15px;">A home for your teams work</p>';
                }
            
                ?>
                <div id="task-form" style="display:none;margin-left:100px;margin-top:100px;">
                        <form action="teamm.php" method="POST" onsubmit="return validate()">   
                            <table style="border:2px solid #333333;border-radius:10px;color:#fff;width:700px;background-color:#1b1b1b;">
                                <tr>
                                    <th style="font-family:Tahoma;margin-top:90px;margin-left:90px;">ADD A TEAM</th>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="teamname"><h4 style="font-family:Tahoma;margin-top:10px;margin-left:10px;color:#ceff1a;">Team Name</h4></label>
                                        <input name="teamname" style="width:700px;font-size:15px;padding-left: 10px;padding-top:10px;padding-bottom:10px;border:none;background-color:#1b1b1b;border-radius: 10px;color:#fff;"type="text" id="teamname" name="teamname" placeholder="The Name of your team or company ">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="des" style="width:700px;font-size:10px;padding-left: 10px;padding-top:10px;padding-bottom:10px;border:none;background-color:#1b1b1b;border-radius: 10px;color:#fff;"type="text" id="des" name="des" placeholder="Description">
                                    </td>
                                <tr>
                                    <td>
                                        <label style="margin-left:10px;font-family:Arial;color:#888888;font-size:14px;margin-bottom:-15px;">Due Date: </label>
                                        <input name="password" style="margin-left:60px;font-size:10px;padding-left: 10px;padding-right: 10px;padding-top:10px;padding-bottom:10px;border:1px solid #333333;background-color:#000;border-radius: 10px;color:#fff;" type="text" placeholder="Enter your Password" id="password" required>
                                        <span id="pwd" style="color:red;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><hr style="border:.5px solid #333333;"></td>
                                </tr>
                                    <td>
                                        <span style="margin-left:345px;"></span>
                                        <button type="button" style="border-radius:5px;background-color:#888888;border:none;height:30px;color:#fff;" onclick="cancelTask()">Cancel</button>
                                        <input type="submit" value="Add Team" style="margin-left:10px;border-radius:5px;background-color:#ceff1a;width:70px;border:none;height:30px;"onclick="addTask()">
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
                    var pwd = document.getElementById('password').value;
                    var msg=document.getElementById('pwd');
                    msg.textContent="";
                    // Password must be at least 8 characters long
                    if (password.length < 8) {
                        msg.textContent="Password must be at least 8 characters long.";
                        return false;
                    }
    
                    // Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character
                    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/;
                    if (!regex.test(password)) {
                        msg.textContent= "Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.";
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