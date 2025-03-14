# TaskEase

TaskEase is a comprehensive task scheduling and reminder web application designed to enhance productivity and time management. Inspired by Todoist, TaskEase provides an intuitive and user-friendly interface to help users efficiently organize their tasks, set reminders, and track progress.

## Features
- **Task Management**: Create, update, and delete tasks effortlessly.
- **Reminders & Notifications**: Set reminders to receive timely notifications.
- **Task Categorization**: Organize tasks into different categories or projects.
- **Due Dates & Priorities**: Assign deadlines and prioritize tasks based on importance.
- **User Authentication**: Secure login and registration system.
- **Responsive Design**: Fully functional across desktop and mobile devices.

## Tech Stack
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL

## Installation

### Prerequisites
- PHP installed on your system
- MySQL server running
- A local server like XAMPP or WAMP

### Steps
1. Clone the repository:
   ```sh
   git clone https://github.com/Praneetha-NM/TaskEase.git
   cd TaskEase
   ```
2. Import the database:
   - Open `phpMyAdmin`
   - Create a new database (e.g., `taskease_db`)
   - Import the provided `.sql` file from the `database` folder

3. Configure the database connection:
   - Open `config.php` in the project root directory
   - Update database credentials as needed

4. Start the local server and run the project:
   - Place the project folder inside `htdocs` (for XAMPP) or `www` (for WAMP)
   - Start Apache and MySQL from XAMPP/WAMP control panel
   - Access the application in the browser: `http://localhost/TaskEase`

## Usage
- Register/Login to access your personalized dashboard.
- Create and manage tasks with due dates and priorities.
- Set reminders for important tasks.
- Organize tasks into categories for better workflow.

## Troubleshooting
- If the database connection fails, ensure that MySQL is running and database credentials are correct in `config.php`.
- If the application does not load, ensure that Apache and MySQL services are started.


## Contact
For any queries, feel free to reach out:
- GitHub: [Praneetha-NM](https://github.com/Praneetha-NM)
- Email: praneetha7597@gmail.com

