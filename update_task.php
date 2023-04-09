<!-- update.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Update Task</title>
    <style>
        /* Internal CSS for basic styling */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
        }
        label, input, select, textarea {
            display: block;
            margin-bottom: 10px;
            width: 100%;
        }
        input[type="submit"] {
            width: auto;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php
    // Connect to the MySQL database
    require_once 'dbConnection.php';

    // Check the database connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the task id is provided in the query string
    if (isset($_GET["id"])) {
        $task_id = $_GET["id"];

        // Retrieve the task data from the tasks table
        $sql = "SELECT * FROM tasks WHERE id = '$task_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $title = $row["title"];
            $description = $row["description"];
            $due_date = $row["due_date"];
            $priority = $row["priority"];
        } else {
            // Task not found, redirect to task_list.php
            header("Location: task_list.php");
            exit();
        }
    } else {
        // Invalid request, redirect to task_list.php
        header("Location: task_list.php");
        exit();
    }

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the form data
        $title = $_POST["title"];
        $description = $_POST["description"];
        $due_date = $_POST["due_date"];
        $priority = $_POST["priority"];

        // Update the task in the tasks table
        $sql = "UPDATE tasks SET title = '$title', description = '$description', due_date = '$due_date', priority = '$priority' WHERE id = '$task_id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Task updated successfully, redirect to task_list.php
            header("Location: task_list.php");
            exit();
        } else {
            // Display error message
            echo "Error updating task: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    <div class="container">
        <h1>Update Task</h1>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . '?id=' . $task_id; ?>">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo $title; ?>" required>
            <br>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo $description; ?></textarea>
            <br>
            <label for="due_date">Due Date:</label>
            <input type="date" name="due_date" id="due_date" value="<?php echo $due_date; ?>" required>
            <br>
            <label for="priority">Priority:</label>
            <select name="priority" id="priority" required>
            <option value="low" <?php if ($priority == "low") echo "selected"; ?>>Low</option>
            <option value="medium" <?php if ($priority == "medium") echo "selected"; ?>>Medium</option>
            <option value="high" <?php if ($priority == "high") echo "selected"; ?>>High</option>
            </select>
            <br>
            <input type="submit" value="Update Task">
        </form>
            <p><a href="task_list.php">Back to Task List</a></p>
   </div>

</body>
</html>
