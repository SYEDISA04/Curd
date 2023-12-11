<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userType = $_POST["userType"];

    // Retrieve user data from the database
    $sql = "SELECT * FROM register WHERE username = '$username' AND userType = '$userType'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Password is correct, set session variables
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];

            // Redirect based on user type
            if ($userType === 'option1') {
                header("Location: agent_welcome.php");
            } elseif ($userType === 'option2') {
                header("Location: admin_welcome.php");
            } else {
                // Handle other user types if needed
                echo "Invalid user type";
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

// $con->close();
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5">
        <form action="first.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
    <label for="exampleDropdown">User Type</label>
    <select class="form-control" id="exampleDropdown" name="userType">
      <option value="option1">Agent</option>
      <option value="option2">Admin</option>
    </select>
  </div>
  <div class="mb-3">
  <button type="submit" class="btn btn-primary">Login</button>
  <!-- <button type="submit" class="btn btn-primary">Sign Up</button> -->
  <div class="mb-3">
                <!-- <button type="submit" class="btn btn-primary">Login</button> -->
                <a href="signup.php" class="btn btn-primary">Sign Up</a>
            </div>
  </div>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
