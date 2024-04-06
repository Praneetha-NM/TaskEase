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
$sql = "SELECT * FROM completed_task WHERE username = ?";
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
        <title>Completed Tasks Page</title>
        <link rel="stylesheet" href="homestyle.css">
        <script>
                function displayTime() {
                    var currentTime = new Date();
                    var hours = currentTime.getHours();
                    var minutes = currentTime.getMinutes();
                    var seconds = currentTime.getSeconds();
                    hours = (hours < 10 ? "0" : "") + hours;
                    minutes = (minutes < 10 ? "0" : "") + minutes;
                    seconds = (seconds < 10 ? "0" : "") + seconds;
                    var meridiem = (hours < 12) ? "AM" : "PM";
                    hours = (hours > 12) ? hours - 12 : hours;
                    hours = (hours == 0) ? 12 : hours;
                    var currentTimeString = hours + ":" + minutes + ":" + seconds + " " + meridiem;
                    document.getElementById("clock").textContent = currentTimeString;
                }
                setInterval(displayTime, 1000);
        </script>
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
                    <a href="comp.php" style="text-decoration:none;">
                        <button style="display:flex;">
                            <img src="comp.png" style="width:20px;height:20px;border-radius:50%;margin-right:10px;">
                            <p style="margin-top:0px;font-size:15px;"> Completed Tasks </p>
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
            <div class="main" style="background-color:#000;width:80%;height:1500px;">
            <br><br><br>
                <span id="clock" style="font-family:Tahoma;font-size:15px;color:#ceff1a;margin-top:30px;margin-left:700px;"></span>
                <div class="green" style="margin-left:850px;margin-top:-30px;">
                    <a href="home.html" style="text-decoration:none;">
                        <button style="width:80px;font-size:13px;height:40px;font-family:Arial;">Log Out</button>
                    </a>
                </div>
                <h2 style="font-family:Tahoma;margin-top:90px;margin-left:90px;color:#ceff1a;">Completed Tasks</h2>
                
                <?php
                if ($result && $result->num_rows > 0) {
                    
                    
                    echo '<div id="task-table" style="background-color:#000;border-radius:10px;color:#fff;width:1000px;margin-top:60px;">';
                    echo '<table style="margin-left:90px;">';

                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td style="width:700px;"> <span style="font-family:Arial;font-size:15px;font-weight:lighter;">' . $row["task_name"] . '</span>';
                        echo '<p style="font-family:Arial;font-size:12px;font-weight:lighter;">' . $row["description"] . '</p>';
                        echo '<p style="font-family:Arial;font-size:12px;font-weight:lighter;color:lightgreen;">' . $row["due_date"] . '</p>';
                        echo '<p style="margin-left:700px;font-family:Arial;font-size:12px;font-weight:lighter;color:lightgrey;">' . $row["category"] . '</p></td>';
                        echo '</tr>';
                        echo '<tr><td style="width:820px;"><hr style="border:.2px solid #666666;></td></tr>';
                    }

                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<img id="fp-image" style="margin-top:30px;margin-left:400px;width:300px;height:300px;" src="compl.png">';
                    echo '<p id="task-info" style="margin-left:480px;font-weight:bold;color:#fff;font-family:Tahoma;">Complete Tasks !!</p>';
                    echo '<p id="task-instructions" style="margin-left:80px;color:lightgrey;text-align:center;font-family:Tahoma;font-size:15px;">No Tasks Completed </p>';
                }
            
                ?>
                
            </div>
        </div>
    </body>
</html>