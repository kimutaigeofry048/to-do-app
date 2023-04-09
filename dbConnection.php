<?php
$conn = mysqli_connect("localhost", "root", "", "task_manager");

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>