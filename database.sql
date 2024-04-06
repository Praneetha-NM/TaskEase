CREATE DATABASE IF NOT EXISTS TaskEase;
USE TaskEase;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE details (
    user_id INT AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    profile_picture BLOB,
    role ENUM('Student', 'Employee', 'Other') NOT NULL,
    want_notification BOOLEAN NOT NULL,
    team_name VARCHAR(255),
    plan ENUM('Personal', 'Education', 'Work') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE task (
    username VARCHAR(255) NOT NULL,
    task_name VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE,
    priority INT,
    category ENUM('Inbox', 'Project') NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (username) REFERENCES users(username)
);
CREATE TABLE completed_task (
    username VARCHAR(255) NOT NULL,
    task_name VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE,
    priority INT,
    category ENUM('Inbox', 'Project') NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (username) REFERENCES users(username)
);
CREATE TABLE team (
    id INT AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    team_name VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE,
    priority INT,
    category ENUM('Inbox', 'Project') NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username)
);
