<?php

require_once __DIR__ . '/../../src/php/Controller/Repo/UsersRepository.php';
require_once __DIR__ . '/../../src/php/Model/PermissionModel.php';


$repo = new UsersRepository();

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

$allUser = $repo->readAllUsers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if ($_SESSION['permission'] == Permission::$read) : ?>
            See Users
        <?php elseif ($_SESSION['permission'] == Permission::$write) : ?>
            Delete Users
        <?php endif ?>
    </title>

    <!-- css files -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/View/css/admin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
    <link rel="stylesheet" href="/public/View/css/add-and-edit-admins.css">

    <!-- in this page i use js function between php code ... we sould include js libs on top of page. -->
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/popper.js/dist/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/see-users.js"></script>

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
            <?php foreach ($allUser as $value) : ?>

                <?php $currentPerm = $repo->getUserByUsername($value['username'])['permission'] ?>

                <div class="admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center <?php if ($_SESSION['permission'] == Permission::$write) echo "write-access"; ?>" id="admin-cart-<?= $value['username'] ?>">

                    <h1 class="flex-grow-1 mt-3"><?= $value['username'] ?></h1>
                    <h4 class="flex-grow-1"><?= $value['email'] ?></h4>

                    <div class="overally <?php if ($_SESSION['permission'] == Permission::$read) echo "hidden"; ?>">
                        <div class="container p-3 h-100">
                            <div class="d-flex flex-column justify-content-around h-75">
                                <h2> Edit Admin </h2>

                                <h4 class="text-center text-white border p-2"><?= $value['username'] ?></h4>
                                <h4 class="text-center text-white border p-2"><?= $value['email'] ?></h4>


                                <button class="m-1 btn btn-secondary text-center" id="delete-<?= $value['username'] ?>">Delete</button>

                                <script>
                                    handleCarts('<?= $value['username'] ?>')
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </main>

    <footer>

    </footer>
</body>

</html>