<?php
session_start();

if (isset($_SESSION["adm"])) {
    header("Location: dashboard.php");
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
}

require_once "db_connect.php";

$sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";

$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

$sqlProducts = "SELECT * FROM animal";
$resultProducts = mysqli_query($connect, $sqlProducts);

$cards = "";

if (mysqli_num_rows($resultProducts) > 0) {
    while ($rowProduct = mysqli_fetch_assoc($resultProducts)) {
        $cards .= "<div class='col-lg-4 col-md-6 col-sm-12 mb-3'>
            <div class='card' style='width: 320px;'>
                <img src='pictures/{$rowProduct["image"]}' class='card-img-top' alt='...' style='height: 440px; object-fit: cover;'>
                <div class='card-body'>
                    <h4 class='card-title'>{$rowProduct["name"]}</h4>
                    <p class='card-text'>Location: {$rowProduct["location"]}</p> 
                    <p class='card-text'>Age: {$rowProduct["age"]}</p> 
                    <p>Size: <a href='sizes.php?size={$rowProduct["size"]}'>{$rowProduct["size"]}</a></p>
                    <p class='card-text'>Description: <br>{$rowProduct["description"]}</p> 
                    <a href='details.php?id={$rowProduct["id"]}' class='btn btn-warning'>Details</a>
                </div>
            </div>
        </div>";
    }
} else {
    $cards = "<p>No results found</p>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?= $row["first_name"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body class="bg-success text-dark bg-opacity-50" style="height: 200vh">
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 20px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="pictures/<?= $row["picture"] ?>" alt="user pic" width="30" height="24">
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size: 24px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="senior.php">Seniors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="junior.php">Juniors</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <h2 class="text-center my-5">Welcome <?= $row["first_name"] . " " . $row["last_name"] ?></h2>

    <div class="container">
        <div class="row">
            <?= $cards ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>