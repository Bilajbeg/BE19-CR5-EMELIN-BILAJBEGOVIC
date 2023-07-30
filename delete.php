<?php
require_once "db_connect.php";

// Validate and sanitize the 'id' parameter from the URL
if (isset($_GET["id"]) && ctype_digit($_GET["id"])) {
    $id = $_GET["id"];

    // Check if the 'id' belongs to an animal or a user
    $sqlCheckAnimal = "SELECT * FROM `animal` WHERE id_pet = ?";
    $stmtCheckAnimal = mysqli_prepare($connect, $sqlCheckAnimal);
    mysqli_stmt_bind_param($stmtCheckAnimal, "i", $id);
    mysqli_stmt_execute($stmtCheckAnimal);
    $animalExists = mysqli_stmt_fetch($stmtCheckAnimal);
    mysqli_stmt_close($stmtCheckAnimal); // Close the statement

    if ($animalExists) {
        // If the 'id' belongs to an animal, delete the animal record
        $sqlDeleteAnimal = "DELETE FROM `animal` WHERE id_pet = ?";
        $stmtDeleteAnimal = mysqli_prepare($connect, $sqlDeleteAnimal);
        mysqli_stmt_bind_param($stmtDeleteAnimal, "i", $id);
        mysqli_stmt_execute($stmtDeleteAnimal);
        mysqli_stmt_close($stmtDeleteAnimal); // Close the statement
    } else {
        // If the 'id' does not belong to an animal, delete the user record
        $sqlDeleteUser = "DELETE FROM `users` WHERE id = ?";
        $stmtDeleteUser = mysqli_prepare($connect, $sqlDeleteUser);
        mysqli_stmt_bind_param($stmtDeleteUser, "i", $id);
        mysqli_stmt_execute($stmtDeleteUser);
        mysqli_stmt_close($stmtDeleteUser); // Close the statement
    }

    // Redirect back to the dashboard after the deletion
    header("location: dashboard.php");
} else {
    echo "Invalid ID";
}
