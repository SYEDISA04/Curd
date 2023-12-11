<?php
session_start();
include 'connect.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Delete user record from the database
    $deleteQuery = "DELETE FROM register WHERE id = $id";

    if ($con->query($deleteQuery) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $con->error;
    }
}

// Redirect back to admin_welcome.php after deleting
header("Location: admin_welcome.php");
exit();
?>
