<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>task</title>
  </head>
  <body>
  <div class="container mt-5">
  <form action="signup.php" method="POST">
  <div class="mb-3">
    <label for="UN" class="form-label">Name</label>
    <input type="text" class="form-control" id="UN" placeholder="It accept alphabets only" name="name"  oninput="validateInput(this)" required>
  </div>
  <div class="mb-3">
    <label for="UN" class="form-label">username</label>
    <input type="text" class="form-control" id="UN" placeholder="Username" name="username" required>
  </div>


<div class="mb-3">
    <label for="mobileNumber">Mobile Number:</label>
    <input type="tel" class="form-control" id="mobileNumber" name="mobileNumber" placeholder="Enter mobile number" required>
</div>

<div class="mb-3">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
</div>
 

<div class="mb-3">
    <label for="age">Age:</label>
    <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required>
</div>


  
<div class="mb-3">
    <label for="dob">Date of Birth:</label>
    <input type="date" class="form-control" id="dob" name="dob" required>
</div>
<div class="form-group">
    <label for="fileUpload">File Upload:</label>
    <input type="file" class="form-control-file" id="fileUpload" name="fileUpload">
</div>
<div class="form-group">
    <label for="imageUpload">Image Upload:</label>
    <input type="file" class="form-control-file" id="imageUpload" name="imageUpload" accept="image/*">
</div>
<div class="mb-3">
    <label for="exampleDropdown">User Type</label>
    <select class="form-control" id="exampleDropdown"  name="userType">
      <option value="option1">Agent</option>
      <option value="option2">Admin</option>
    </select>
  </div>
 <!-- Previous code -->

<div class="mb-3">
    <label>Gender:</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="male" value="male">
        <label class="form-check-label" for="male">Male</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
        <label class="form-check-label" for="female">Female</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="other" value="other">
        <label class="form-check-label" for="other">Other</label>
    </div>
   
</div>

<!-- Continue with the rest of your form -->

  <div class="mb-3">
    <label for="PWD" class="form-label">Password</label>
    <input type="password" class="form-control" id="PWD" placeholder="password" name="password" required>
  </div>
  </div>

  <div class="mb-3 text-center">
  <button type="reset" class="btn btn-primary">Reset</button>
  <button type="submit" class="btn btn-primary">Register</button>
  </div>
</form>



  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>



<?php

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $mobileNumber = mysqli_real_escape_string($con, $_POST["mobileNumber"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $age = mysqli_real_escape_string($con, $_POST["age"]);
    $dob = mysqli_real_escape_string($con, $_POST["dob"]);

    // Check if file uploads are set and successful
    $fileUpload = isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] == 0 ? mysqli_real_escape_string($con, $_FILES["fileUpload"]["name"]) : null;
    $imageUpload = isset($_FILES["imageUpload"]) && $_FILES["imageUpload"]["error"] == 0 ? mysqli_real_escape_string($con, $_FILES["imageUpload"]["name"]) : null;

    $userType = mysqli_real_escape_string($con, $_POST["userType"]);
    $gender = mysqli_real_escape_string($con, $_POST["gender"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hashing the password for security

    // Check if the username already exists in the database
    $checkUsernameQuery = "SELECT * FROM register WHERE username = '$username'";
    $result = $con->query($checkUsernameQuery);

    if ($result && $result->num_rows > 0) {
        // Username already exists, handle accordingly (e.g., show an error message)
        echo "Username already exists. Please choose a different username.";
    } else {
        // Username doesn't exist, proceed with registration
        // Insert data into the users table
        $sql = "INSERT INTO register (name, username, mobileNumber, email, age, dob, fileUpload, imageUpload, userType, gender, password)
        VALUES ('$name', '$username', '$mobileNumber', '$email', $age, '$dob', '$fileUpload', '$imageUpload', '$userType', '$gender', '$password')";

        if ($con->query($sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}

// Close the connection
// $con->close();
?>
