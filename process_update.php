<!-- process_update.php -->
<?php
session_start(); // Start the session
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["user_id"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $mobileNumber = $_POST["mobileNumber"];
    $email = $_POST["email"];

    // Update user details in the database
    $sql = "UPDATE register SET name='$name', username='$username', mobileNumber='$mobileNumber', email='$email' WHERE id='$userId'";
    
    if ($con->query($sql) === TRUE) {
        // echo "User details updated successfully";
        header("Location: admin_welcome.php");
        exit();
    } else {
        echo "Error updating user details: " . $con->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$con->close();
?>
