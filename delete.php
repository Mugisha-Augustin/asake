<?php
include('connection.php'); // Include your DB connection file

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare delete query
    $dl = "DELETE FROM students WHERE s_id='$id'";

    if ($con->query($dl)) {
        // Redirect to index after successful deletion
        header('Location: index.php');
        exit(); // Always use exit after header
    } else {
        echo "Error deleting record: " . $con->error;
    }
} else {
    echo "No student ID provided!";
}
?>
