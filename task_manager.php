<!-- task_manager.php -->
<?php
    // Connect to the MySQL database
    require_once 'dbConnection.php';
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the form data
        $title = $_POST["title"];
        $description = $_POST["description"];
        $due_date = $_POST["due_date"];
        $priority = $_POST["priority"];

        // Insert the new task into the tasks table
        $sql = "INSERT INTO tasks (title, description, due_date, priority) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $title, $description, $due_date, $priority);
        mysqli_stmt_execute($stmt);

        // Redirect to the task list page
        header("Location: task_list.php");
        exit();
    }
    ?>
<!-- HTML form for creating a new task -->
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="task_manager.css"> <!-- Include your CSS file here -->

<head>
    <link rel="stylesheet" href="task_manager.css">
</head>
<body>
    <h1 style="text-align:center">Task Manager</h1>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>
    <br>
    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>
    <br>
    <label for="due_date">Due Date:</label>
    <input type="date" name="due_date" id="due_date" required>
    <br>
    <label for="priority">Priority:</label>
    <select name="priority" id="priority" required>
        <option value="high">High</option>
        <option value="medium">Medium</option>
        <option value="low">Low</option>
    </select>
    <br>
    <input type="submit" value="Create Task">
    <a href="task_list.php" 
    style="float:right; 
    background-color:#007bff;
    color:white; padding: 10px; 
    text-decoration:none" > 
    View Tasks</a>
</form>
</body>
</html>