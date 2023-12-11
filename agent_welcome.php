<!-- admin_welcome.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Agent Welcome</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome, Agent</h1>

        <?php
session_start(); // Start the session
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Retrieve user data from the database
    $sql = "SELECT * FROM register WHERE username = '$username'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Password is correct, set session variables
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];

            // Set user type session variable
            $_SESSION["userType"] = $row["userType"];

            // Redirect to a welcome page or dashboard
            if ($_SESSION["userType"] == "agent") {
                header("Location: agent_welcome.php");
            } else {
                header("Location: welcome.php");
            }
            exit();
        } else {
            // Incorrect password, handle accordingly (e.g., show an error message)
            echo "Incorrect password";
        }
    } else {
        // User not found, handle accordingly (e.g., show an error message)
        echo "User not found";
    }
}

// $con->cslose();
?>
<?php
// Retrieve all users from the database
$query = "SELECT * FROM register";
$result = $con->query($query);

if ($result === false) {
    // Check for errors in the query
    echo "Error in query: " . $con->error;
} else {
    if ($result->num_rows > 0) {
        echo '<table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['mobileNumber'] . '</td>
                    <td>' . $row['email'] . '</td>
                </tr>';
        }

        echo '</tbody>
            </table>';
    } else {
        echo '<p>No users found.</p>';
    }
}

// Close the database connection
// $con->close();
?>



    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
