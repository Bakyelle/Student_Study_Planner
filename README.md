# Student Study Planner

A simple web-based application built with PHP and MySQL to help students organize their study tasks and track due dates. It was created as a university project work.

## Features

- Add study tasks with subject, description, and due date
- Clean, modern dark-themed UI
- Form validation for required fields and date format
- Database integration for persistent storage
- Responsive design

## Prerequisites

- PHP 7.0 or higher
- MySQL 5.7 or higher
- Web server (e.g., Apache, Nginx) with PHP support

## Installation

1. Clone or download the project files to your web server's document root.

2. Set up the database:
   - Open your MySQL client or phpMyAdmin.
   - Run the SQL script in `Database/Query.sql` to create the database and table.

3. Configure database connection:
   - Open `planner.php`.
   - Update the database credentials if necessary:
     ```php
     $host = 'localhost';
     $db   = 'study_planner_db';
     $user = 'root';
     $pass = '';
     ```

4. Ensure your web server is running and PHP is configured correctly.

## Usage

1. Open your web browser and navigate to the URL where you placed the `planner.php` file (e.g., `http://localhost/student_planner/planner.php`).

2. Fill in the form:
   - **Subject**: Enter the subject name (e.g., Mathematics).
   - **Task**: Describe the study task in detail.
   - **Due Date**: Select the due date using the date picker.

3. Click "Add To Planner" to save the task.

4. The application will display a success message if the task is added successfully, or an error message if there are issues.

## Database Schema

The application uses a single table `tasks` with the following structure:

- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `subject` (VARCHAR(255), NOT NULL)
- `task` (TEXT, NOT NULL)
- `due_date` (DATE, NOT NULL)
- `created_at` (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)

## File Structure

```
Student Planner/
├── planner.php          # Main application file
├── Database/
│   └── Query.sql        # Database setup script
└── README.md            # This file
```

## Contributing

Feel free to fork this project and submit pull requests with improvements or bug fixes.

## License

This project is open source and available under the [MIT License](https://opensource.org/licenses/MIT).
