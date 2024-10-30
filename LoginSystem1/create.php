<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config.php";

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password
    $gender = $_POST['gender'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `users` (`firstName`, `lastName`, `email`, `password`, `gender`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $password, $gender);

    if ($stmt->execute()) {
        echo "Successfully added new user.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Close the prepared statement
    $conn->close(); // Close the connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #282d31; /* Dark background color */
        }
        .table {
            background-color: #343a40; /* Table background color */
            border-radius: 8px; /* Rounded corners only for the four outer corners */
            overflow: hidden; /* Ensures rounding is visible even on rows */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #495057; /* Slightly lighter background for odd rows */
        }
        .table th, .table td {
            vertical-align: middle; /* Center align table content */
        }
    </style>
</head>
<body>
<div class="container-fluid bg-#282d31 text-light py-3" >
        <header class="text-center">
            <h1 ><a href="main.php" class="text-light text-decoration-none">User Management System</a>
            </h1>
        </header>
    <div class="container mt-4">
        <h2>Application Form</h2>
        <form action="" method="POST">
            <div class="row mb-3">
                <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" name="firstName" class="form-control" id="firstName" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" name="lastName" class="form-control" id="lastName" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="inputEmail3" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="inputPassword3" required>
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" checked>
                        <label class="form-check-label" for="gridRadios1">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female">
                        <label class="form-check-label" for="gridRadios2">Female</label>
                    </div>
                </div>
            </fieldset>
            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
</body>
</html>
