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

if ($_SESSION['permission'] == 0) {
    header("location: /public/");
}

$allAdmins = $repo->readAllAdmins();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if ($_SESSION['permission'] == Permission::$read) : ?>
            See Admins
        <?php elseif ($_SESSION['permission'] == Permission::$write) : ?>
            Admin CRUD
        <?php endif ?>
    </title>

    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/View/css/admin.css">
    <link rel="stylesheet" href="/public/View/css/add-and-edit-admins.css">

</head>

<body>

    <header class="container-fluid">
        <div class="container d-flex flex-row p-3 ">
            <h3 class="p-1 mr-2 ml-n1 text-white">Signal Marketing</h3>

            <p class="flex-grow-1"></p>

            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><?= $_COOKIE['admin'] ?></button>
                <ul class="dropdown-menu">
                    <li><a href="/public/">Home</a></li>
                    <li><a href="/public/admin/edit-password.php">Edit Password</a></li>
                    <li><a href="/public/admin/index.php?request=logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main>
        <div class="container-fluid p-5 d-flex flex-wrap">
            <?php foreach ($allAdmins as $value) : ?>
                <?php $currentPerm = $repo->getAdminByUsername($value['username'])['permission'] ?>
                <?php $accessIntro = "" ?>

                <div class="container border shadow m-5 text-center w-auto overflow-hidden" id="admin-cart">
                    <?php if ($currentPerm == Permission::$read) : ?>
                        <img class="m-2 mb-4" src="/public/View/img/read-access.png" alt="read access">
                        <?php $accessIntro = "Just can see another admins." ?>
                    <?php elseif ($currentPerm == Permission::$write) : ?>
                        <img class="m-2 mb-4" src="/public/View/img/write-access.png" alt="write access">
                        <?php $accessIntro = "Super admin.<br>
                         He can: <br>
                         <ul>
                            <li>Create new admin</li>
                            <li>Edit exist admins</li>
                            <li>Delete exist admins</li>
                         </ul>" ?>
                    <?php else : ?>
                        <img class="m-2 mb-4" src="/public/View/img/limited.png" alt="limited">

                        <?php $accessIntro = "he has no access" ?>
                    <?php endif ?>

                    <h1><?= $value['username'] ?></h1>
                    <h6 class="text-left p-3"><?= $accessIntro ?></h6>
                </div>
            <?php endforeach ?>
        </div>
    </main>

    <footer>

    </footer>

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/popper.js/dist/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/add-and-edit-admins.js"></script>
</body>

</html>