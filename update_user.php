<!-- update_user.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Update User</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Update User</h2>

        <?php
        session_start(); // Start the session
        include 'connect.php';

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
            $userId = $_GET["id"];

            // Retrieve user data from the database
            $sql = "SELECT * FROM register WHERE id = '$userId'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>

                <form method="post" action="process_update.php">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="mobileNumber">Mobile Number:</label>
                        <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" value="<?php echo $row['mobileNumber']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                    </div>

                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    
                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>

                <?php
            } else {
                echo "User not found.";
            }
        } else {
            echo "Invalid request.";
        }

        // Close the database connection
        $con->close();
        ?>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
