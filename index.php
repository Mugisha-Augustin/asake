<?php
include('connection.php'); // Make sure $con is properly defined here

// SQL query to get all students
$ql = "SELECT * FROM students";

// Execute the query
$result = $con->query($ql);

// Check if there are any results
if ($result && $result->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Action</th>
          </tr>";

    // Loop through each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['s_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['location']) . "</td>";
        
        // Add action buttons
        echo "<td>
                <a href='edit.php?id=" . urlencode($row['s_id']) . "'>Edit</a> |
                <a href='delete.php?id=" . urlencode($row['s_id']) . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No student records found.";
}

// Close the connection
$con->close();
?>
