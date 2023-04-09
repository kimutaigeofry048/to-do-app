<!-- tasklist.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
    <link rel="stylesheet" href="task_list.css"> <!-- Include your CSS file here -->
</head>
<body>
    <h1>Task List</h1>

    <?php
    // Connect to the MySQL database
    require_once 'dbConnection.php';

    // Check the database connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch tasks from the tasks table
    $sql = "SELECT * FROM tasks";
    $result = mysqli_query($conn, $sql);

    // Check if tasks exist
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Description</th>";
        echo "<th>Due Date</th>";
        echo "<th>Priority</th>";
        echo "<th>Actions</th>";
        echo "</tr>";

        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["due_date"] . "</td>";
            echo "<td>" . $row["priority"] . "</td>";
            echo "<td>";
            echo "<a href='view_task.php?id=" . $row["id"] . "'>View</a> | ";
            echo "<a href='update_task.php?id=" . $row["id"] . "'>Update</a> | ";
            echo "<a href='delete_task.php?id=" . $row["id"] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No tasks found.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <a href="task_manager.php">Create New Task</a>
</body>
</html>
