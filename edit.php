<?php
include('connection.php');

// Initialize variables
$id = "";
$name = "";
$location = "";
$message = "";

// Step 1: Fetch existing student data when 'edit' link is clicked (via GET)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $con->query("SELECT * FROM students WHERE s_id='$id'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $location = $row['location'];
    }
}

// Step 2: Update record when form is submitted
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $up = "UPDATE students SET name='$name', location='$location' WHERE s_id='$id'";

    if ($con->query($up)) {
        $message = "✅ Record updated successfully!";
        header('location:index.php');
    } else {
        $message = "❌ Error updating record: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 50px;
        }
        .form-container {
            background: #fff;
            width: 400px;
            padding: 20px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="hidden"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .message {
            margin-top: 15px;
            text-align: center;
            color: green;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Student</h2>

    <?php if ($message != "") echo "<p class='message'>$message</p>"; ?>

    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label>Student Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>

        <label>Location:</label>
        <input type="text" name="location" value="<?php echo $location; ?>" required>

        <button type="submit" name="update">Update</button>
    </form>
</div>

</body>
</html>
