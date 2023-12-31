<?php
session_start();

// Check if neither "user" nor "adm" session is set, redirect to login
if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit;
}

require_once "db_connect.php";

$sql = "SELECT * FROM `animal` WHERE `age` < 3 ";

$result = mysqli_query($connect, $sql);

$cards = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cards .= "<div class='col-lg-4 col-md-6 col-sm-12 mb-3'>
            <div class='card' style='width: 320px;'>
                <img src='pictures/{$row["image"]}' class='card-img-top' alt='...' style='height: 440px; object-fit: cover;'>
                <div class='card-body'>
                    <h4 class='card-title'>{$row["name"]}</h4>
                    <p class='card-text'>Location: {$row["location"]}</p> 
                    <p class='card-text'>Age: {$row["age"]}</p> 
                    <p>Size: <a href='sizes.php?size={$row["size"]}'>{$row["size"]}</a></p>
                    <p class='card-text'>Description: <br>{$row["description"]}</p>";

        // Check if an admin is logged in to display their picture and email
        if (isset($_SESSION["adm"])) {
            $cards .= "<a href='details.php?id={$row["id_pet"]}' class='btn btn-warning'>Details</a>
                <a href='update.php?id={$row["id_pet"]}' class='btn btn-success mx-2'>Edit</a>
                <a href='delete.php?id={$row["id_pet"]}' class='btn btn-danger'>Delete</a>";
        } else {
            // Regular user, hide edit and delete buttons
            $cards .= "<a href='details.php?id={$row["id_pet"]}' class='btn btn-warning'>Details</a>
            <a href='home.php' class='btn btn-secondary my-2' style='width: auto;'>Back</a>";
        }

        $cards .= "</div>
            </div>
        </div>";
    }
} else {
    $cards = "<p>No results found</p>";
}

// Fetch the user's data if available
$userRow = null;
if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
    $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
    $resultUser = mysqli_query($connect, $sqlUser);
    $userRow = mysqli_fetch_assoc($resultUser);
}

// Fetch the admin's data if available
$adminRow = null;
if (isset($_SESSION["adm"]) && $_SESSION["adm"] != null) {
    $sqlAdmin = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
    $resultAdmin = mysqli_query($connect, $sqlAdmin);
    $adminRow = mysqli_fetch_assoc($resultAdmin);
}

mysqli_close($connect);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juniors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-image: url('pictures/bg_3.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
</head>

<body class="text-dark" style="height: 200vh">

    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 20px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <?php if ($userRow) : ?>
                    <img src="pictures/<?= $userRow["picture"] ?>" alt="user pic" width="40" height="30">
                    <?= $userRow["email"] ?>
                <?php elseif ($adminRow) : ?>
                    <img src="pictures/<?= $adminRow["picture"] ?>" alt="admin pic" width="40" height="30">
                    <?= $adminRow["email"] ?>
                <?php else : ?>
                    Junior Page
                <?php endif; ?>
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
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="sizes.php?size=big">Big pets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="sizes.php?size=small">Small pets</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container">
        <div class="d-flex justify-content-center"> <!-- Use d-flex and justify-content-center to center the heading -->
            <h1 class="mt-5 mb-3 text-success-emphasis bg-info-subtle shadow p-3 mb-5 bg-body-tertiary rounded" style="max-width: 250px; padding-left:5px; padding-bottom:5px; text-shadow: 3px 3px 3px gray;">Animal list</h1>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
            <?= $cards ?>
        </div>
    </div>

    <footer class="navbar navbar-expand-lg bg-body-tertiary fixed-bottom">
        <div class="container-fluid d-flex justify-content-center">
            <div class="text-center p-3" style="font-size: 18px;">
                <strong>© 2023 Copyright: Emelin Bilajbegovic</strong>
            </div>
        </div>
    </footer>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>