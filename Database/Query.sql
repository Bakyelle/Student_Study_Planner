CREATE DATABASE study_planner_db;

USE study_planner_db;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL,
    task TEXT NOT NULL,
    due_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);