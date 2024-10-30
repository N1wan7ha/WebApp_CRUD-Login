<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php";

if (isset($_POST['update'])) {
    // Sanitize inputs
    $user_id = intval($_POST['id']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Handle password securely
    $gender = $_POST['gender'];

    // Prepare statement
    $stmt = $conn->prepare("UPDATE `users` SET `firstName` = ?, `lastName` = ?, `email` = ?, `password` = ?, `gender` = ? WHERE `id` = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Hash the password if it's being updated
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    } else {
        // Handle case where password is not updated
        $hashedPassword = ""; // This would require an additional logic
    }

    $stmt->bind_param("sssssi", $firstName, $lastName, $email, $hashedPassword, $gender, $user_id);

    if ($stmt->execute()) {
        echo "User Updated Successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Close the prepared statement
}

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `id` = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        // Ensure not to expose the actual password for security
        $gender = $row['gender'];
    } else {
        echo "User not found";
        exit;
    }

    $stmt->close(); // Close the prepared statement
} else {
    echo "No user ID provided";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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
<div class="container-fluid bg-#282d31 text-light py-3" >
        <header class="text-center">
            <h1 ><a href="main.php" class="text-light text-decoration-none">User Management System</a>
            </h1>
        </header>
<body>
<div class="container mt-4 text-light">
    <h2>User Update Form</h2>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_id); ?>">
        
        <div class="row mb-3">
            <label for="firstName" class="col-sm-2 col-form-label text-light">First Name</label>
            <div class="col-sm-10">
                <input type="text" name="firstName" class="form-control" id="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="lastName" class="col-sm-2 col-form-label text-light">Last Name</label>
            <div class="col-sm-10">
                <input type="text" name="lastName" class="form-control" id="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo htmlspecialchars($email); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Leave blank to keep current password">
            </div>
        </div>

        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" <?php if ($gender == 'male') echo 'checked'; ?>>
                    <label class="form-check-label" for="gridRadios1">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female" <?php if ($gender == 'female') echo 'checked'; ?>>
                    <label class="form-check-label" for="gridRadios2">Female</label>
                </div>
            </div>
        </fieldset>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
