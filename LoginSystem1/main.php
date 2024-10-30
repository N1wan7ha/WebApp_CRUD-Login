<?php
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .btn-bottom-left {
            position: fixed;
            bottom: 100px; 
            left: 20px;  
        }
    </style>
    <title>User Mgt</title>
</head>
<body class="bg-dark text-light">
    <div class="container-fluid bg-dark text-light py-3">
        <header class="text-center">
            <h1><a href="main.php" class="text-light text-decoration-none">User Management System</a></h1>
        </header>
    </div>
<br>
<br>
    <div class="container-fluid py-3">
        <h3><a href="read.php" class="text-light text-decoration-none">View All Users</a></h3>
        <br>
        <h3><a href="create.php" class="text-light text-decoration-none">Register New User</a></h3>
    </div>

    <!-- Logout Button Form -->
    <form method="post">
        <button type="submit" name="logout" class="btn btn-primary btn-bottom-left">Logout</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
