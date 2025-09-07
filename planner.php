<?php

$host = 'localhost';
$db   = 'study_plan_db';
$user = 'root';     
$pass = '';         
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$message = '';

try {
 
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    exit('Database connection failed: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $subject = trim($_POST['subject'] ?? '');
    $task = trim($_POST['task'] ?? '');
    $due_date = trim($_POST['due_date'] ?? '');

    if (empty($subject) || empty($task) || empty($due_date)) {
        $message = 'Please fill in all fields.';
    } else {
        // Validate date format (YYYY-MM-DD)
        $date = DateTime::createFromFormat('Y-m-d', $due_date);
        if (!$date || $date->format('Y-m-d') !== $due_date) {
            $message = 'Invalid date format. Please use YYYY-MM-DD.';
        } else {
            // Insert data into database
            $stmt = $pdo->prepare("INSERT INTO tasks (subject, task, due_date) VALUES (?, ?, ?)");
            if ($stmt->execute([$subject, $task, $due_date])) {
                $message = 'Task added successfully!';
            } else {
                $message = 'Error adding task.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Student Study Planner</title>
<style>
    body {
        background-color: #121212;
        color: #eee;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        background: #1E1E1E;
        border-radius: 12px;
        padding: 30px;
        width: 400px;
        box-shadow: 0 0 20px #6c63ff;
    }
    h1 {
        text-align: center;
        font-weight: 700;
        font-size: 2.5rem;
        background: linear-gradient(90deg, #7b4dff, #3cbae3);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 25px;
    }
    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
    }
    input[type="text"],
    textarea,
    input[type="date"] {
        width: 100%;
        background: #2a2a2a;
        border: none;
        padding: 14px;
        border-radius: 8px;
        color: #ccc;
        font-size: 1rem;
        margin-bottom: 20px;
        resize: vertical;
        box-sizing: border-box;
    }
    input[type="text"]::placeholder,
    textarea::placeholder {
        color: #666;
        font-style: italic;
    }
    button {
        width: 100%;
        background-color: #7b4dff;
        border: none;
        padding: 14px;
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.25s ease;
    }
    button:hover {
        background-color: #623dda;
    }
    .message {
        text-align: center;
        margin-bottom: 20px;
        font-weight: 600;
        color: #7b4dff;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Student Study Planner</h1>
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="e.g. Mathematics" value="<?= isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '' ?>" required />

            <label for="task">Task</label>
            <textarea id="task" name="task" placeholder="Describe the study task..." rows="4" required><?= isset($_POST['task']) ? htmlspecialchars($_POST['task']) : '' ?></textarea>

            <label for="due_date">Due Date</label>
            <input type="date" id="due_date" name="due_date" placeholder="mm/dd/yyyy" value="<?= isset($_POST['due_date']) ? htmlspecialchars($_POST['due_date']) : '' ?>" required />

            <button type="submit">Add To Planner</button>
        </form>
    </div>
</body>
</html>