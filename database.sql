CREATE DATABASE IF NOT EXISTS TaskEase;

-- Use TaskEase database
USE TaskEase;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
