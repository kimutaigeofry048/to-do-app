<!-- view_task.php -->
<!DOCTYPE html>
<html>
<head>
    <title>View Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .task-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .task-details label {
            font-weight: bold;
        }

        .task-details span {
            font-weight: normal;
        }

        .action-links {
            margin-top: 20px;
        }

        .action-links a {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Task Details</h1>

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

            // Fetch task details from the tasks table
            $sql = "SELECT * FROM tasks WHERE id = '$task_id'";
            $result = mysqli_query($conn, $sql);

            // Check if the task exists
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                echo "<div class='task-details'>";
                echo "<label>Title:</label><span>" . $row["title"] . "</span>";
                echo "<label>Description:</label><span>" . $row["description"] . "</span>";
                echo "<label>Due Date:</label><span>" . $row["due_date"] . "</span>";
                echo "<label>Priority:</label><span>" . $row["priority"] . "</span>";
                echo "</div>";

                echo "<div class='action-links'>";
                echo "<a href='task_list.php'>Back to Task List</a>";
                echo "<a href='update_task.php?id=" . $row["id"] . "'>Update Task</a>";
                echo "<a href='delete_task.php?id=" . $row["id"] . "'>Delete Task</a>";
                echo "</div>";
            } else {
                echo "Task not found.";
            }
        } else {
            echo "Task not found.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
