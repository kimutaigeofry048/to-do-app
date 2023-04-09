<!-- delete_task.php -->
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

    // Delete the task from the tasks table
    $sql = "DELETE FROM tasks WHERE id = '$task_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Task deleted successfully, redirect to task_list.php
        header("Location: task_list.php");
        exit();
    } else {
        // Display error message
        echo "Error deleting task: " . mysqli_error($conn);
    }
} else {
    // Invalid request, redirect to task_list.php
    header("Location: task_list.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
