<?php
require_once "db_connect.php";

// Validate and sanitize the 'id' parameter from the URL
if (isset($_GET["id"]) && ctype_digit($_GET["id"])) {
    $id = $_GET["id"];

    // Prepare and execute the DELETE query for the 'animal' table
    $sqlAnimal = "DELETE FROM `animal` WHERE id_pet = ?";
    $stmtAnimal = mysqli_prepare($connect, $sqlAnimal);
    mysqli_stmt_bind_param($stmtAnimal, "i", $id);
    mysqli_stmt_execute($stmtAnimal);

    // Prepare and execute the DELETE query for the 'users' table
    $sqlUser = "DELETE FROM `users` WHERE id = ?";
    $stmtUser = mysqli_prepare($connect, $sqlUser);
    mysqli_stmt_bind_param($stmtUser, "i", $id);
    mysqli_stmt_execute($stmtUser);

    // Redirect back to the dashboard after the deletion
    header("location: dashboard.php");
} else {
    echo "Invalid ID";
}
