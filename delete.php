<?php
require_once "db_connect.php";

$id = $_GET["id"];

$sqlAnimal = "DELETE FROM `animal` WHERE id = $id";
$sqlUser = "DELETE FROM `users` WHERE id = $id";

if (mysqli_query($connect, $sqlAnimal) || mysqli_query($connect, $sqlUser)) {
    header("location: dashboard.php");
} else {
    echo "Error";
}
