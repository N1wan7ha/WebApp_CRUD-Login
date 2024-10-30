<?php
include "config.php";

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Correct SQL DELETE syntax
    $query = "DELETE FROM `users` WHERE `id` = '$user_id'";

    $result = $conn->query($query);

    if ($result == true) {
        echo "User deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
