<?php
session_start();

require_once "db_connect.php";

$sizeFilter = $_GET['size'] ?? ''; // Get the 'size' parameter from the URL

// Validate the size filter
if ($sizeFilter !== 'big' && $sizeFilter !== 'small' && $sizeFilter !== 'medium') {
    header("Location: home.php"); // Invalid size filter, redirect to the home page
    exit();
}

// Build the SQL query based on the size filter
if ($sizeFilter === 'big') {
    $sql = "SELECT * FROM `animal` WHERE `size` = 'big'";
} elseif ($sizeFilter === 'small') {
    $sql = "SELECT * FROM `animal` WHERE `size` = 'small'";
} else {
    $sql = "SELECT * FROM `animal` WHERE `size` = 'medium'";
}

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

        // Check if a user is logged in to display their picture and email
        if (isset($_SESSION["user"])) {
            $cards .= "<a href='details.php?id={$row["id_pet"]}' class='btn btn-warning'>Details</a>
            <a href='home.php' class='btn btn-secondary my-2' style='width: auto;'>Back</a>";
        }

        // Check if an admin is logged in to display their picture and email
        if (isset($_SESSION["adm"])) {
            $cards .= "<a href='details.php?id={$row["id_pet"]}' class='btn btn-warning'>Details</a>
                <a href='update.php?id={$row["id_pet"]}' class='btn btn-success mx-2'>Edit</a>
                <a href='delete.php?id={$row["id_pet"]}' class='btn btn-danger'>Delete</a>";
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
if (isset($_SESSION["user"])) {
    $sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
    $resultUser = mysqli_query($connect, $sqlUser);
    $userRow = mysqli_fetch_assoc($resultUser);
}

// Fetch the admin's data if available
$adminRow = null;
if (isset($_SESSION["adm"])) {
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
</head>

<body class="bg-success text-dark bg-opacity-50" style="height: 400vh">

    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 20px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <?php if ($userRow || $adminRow) : ?>
                    <?php if ($adminRow) : ?>
                        <img src="pictures/<?= $adminRow["picture"] ?>" alt="user pic" width="30" height="24">
                        <?= $adminRow["email"] ?>
                    <?php else : ?>
                        <img src="pictures/<?= $userRow["picture"] ?>" alt="user pic" width="30" height="24">
                        <?= $userRow["email"] ?>
                    <?php endif; ?>
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
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="sizes.php?size=big">Big</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="sizes.php?size=small">Small</a>
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