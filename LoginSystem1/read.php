<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php"; // Include the database connection

$query = "SELECT * FROM users"; 
$result = $conn->query($query);

// Check for errors in query execution
if ($result === false) {
    die("Error executing query: " . $conn->error . " - Query: " . $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
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
        <br>
<div class="container mt-4">
    <h2 class="text-left">User List</h2>
    <br>
    <table class="table table-striped">
        <thead class="bg-light text-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                <tr class="bg-light text-dark">
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['firstName']); ?></td>
                    <td><?php echo htmlspecialchars($row['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td>
                        <a class="btn btn-info" href="update.php?id=<?php echo urlencode($row['id']); ?>">Edit</a>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo urlencode($row['id']); ?>">Delete</a>
                    </td>
                </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>

</html>
