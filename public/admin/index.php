<?php

require_once __DIR__ . '/../../src/php/Controller/Repo/AdminsRepository.php';

$repo = new AdminsRepository();

session_start();

$_SESSION['admin'] = $_COOKIE['admin'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    setcookie(
        "admin",
        $_POST['username'],
        time() + (50 * 50 * 24 * 100)
    );

    $_SESSION['admin'] = $_POST['username'];
    echo "cookie admin crated : " . $_COOKIE['admin'];
    header("location: /public/admin");
}

if (!isset($_COOKIE['admin']))
    header("location: /public/admin/admin-login.php");

if (
    $_SERVER['REQUEST_METHOD'] == 'GET' and
    $_GET['request'] == "logout"
) {
    setcookie(
        "admin",
        null,
        time() - 3600
    );

    $_SERVER['admin'] = null;

    header("location: /public/admin");
}

// calculate admin permission
$permission = $repo->getAdminByUsername($_COOKIE['admin'])['permission'];
$_SESSION['permission'] = $permission;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/View/css/admin.css">

</head>

<body>

    <header class="container-fluid">
        <div class="container d-flex flex-row p-3 ">
            <h3 class="p-1 mr-2 ml-n1 text-white">Signal Marketing</h3>

            <p class="flex-grow-1"></p>

            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><?= $_COOKIE['admin'] ?></button>
                <ul class="dropdown-menu">
                    <li><a href="/public/admin/edit-password.php">Edit Password</a></li>
                    <li><a href="/public/admin/see-users.php">See users</a></li>

                    <?php if ($permission == Permission::$read) : ?>
                        <li><a href="/public/admin/add-and-edit-admins.php">see another admins</a></li>
                    <?php elseif ($permission == Permission::$write) : ?>
                        <li><a href="/public/admin/add-and-edit-admins.php">Add & Edit & Delete another admins</a></li>
                    <?php endif ?>

                    <li><a href="/public/admin/index.php?request=logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main>
        <h1>TODO</h1>
        <!-- TODO -->
    </main>

    <footer>

    </footer>

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/popper.js/dist/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/admin.js"></script>
</body>

</html>