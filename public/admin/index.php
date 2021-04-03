<?php

require_once __DIR__ . '/../../src/php/Controller/Repo/AdminsRepository.php';
require_once __DIR__ . '/../../src/php/Controller/Repo/ProductsRepository.php';


$ARepo = new AdminsRepository();
$PRepo = new ProductsRepository();

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
$permission = $ARepo->getAdminByUsername($_COOKIE['admin'])['permission'];
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

    <!-- add js -->

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/popper.js/dist/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/admin.js"></script>

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
        <div id="according">
            <!-- new product -->
            <div class="card">
                <div class="card-header text-center">
                    <a href="#new-product" data-toggle="collapse" class="card-link">new product</a>
                </div>

                <div id="new-product" class="collapse show" data-parent="#according">
                    <div class="card-body">
                        <div>
                            <div class="container d-flex justify-content-center">
                                <div class="admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center justify-content-center write-access">
                                    <img src="/public/View/img/plus-icon.png" alt="">
                                    <div class="overally <?php if ($_SESSION['permission'] == Permission::$read) echo "hidden"; ?>">
                                        <div class="container p-3 h-100">
                                            <div class="d-flex flex-column justify-content-around h-75">
                                                <h2> New Admin </h2>

                                                <input type="text" id="username" placeholder="Enter new username" onkeyup="onUsernameKeyUp()" autocomplete="off">
                                                <p class="text-danger" id="username-error"></p>
                                                <input type="password" id="password" placeholder="Enter password" onkeyup="onPasswordKeyUp()" disabled>

                                                <select class="permission" id="permission">
                                                    <option value="0">0</option>
                                                    <option value="2">2</option>
                                                    <option value="6">6</option>
                                                </select>


                                                <button class="m-1 btn btn-secondary text-center" id="new" onclick="onNewKeyUp()" disabled>Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- send final file -->
            <div class="card">
                <div class="card-header text-center">
                    <a href="#send-final-file" data-toggle="collapse" class="card-link">send final file</a>
                </div>

                <div id="send-final-file" class="collapse" data-parent="#according">
                    <div class="card-body">
                        send final file
                    </div>
                </div>
            </div>

            <!-- accept price and date for payment -->
            <div class="card">
                <div class="card-header text-center">
                    <a href="#accept-price" data-toggle="collapse" class="card-link">accept price and date for payment</a>
                </div>

                <div id="accept-price" class="collapse" data-parent="#according">
                    <div class="card-body">
                        accept price and date for payment
                    </div>
                </div>
            </div>

            <!-- registred products that just filled primary fields -->
            <div class="card">
                <div class="card-header text-center">
                    <a href="#accept-registred" data-toggle="collapse" class="card-link">registred products that just filled primary fields</a>
                </div>

                <div id="accept-registred" class="collapse" data-parent="#according">
                    <div class="card-body">

                        <!-- card body -->
                        <div class="container-fluid p-5 d-flex flex-wrap">
                            <?php foreach ($PRepo->getProductsByAdminName($_SESSION['admin']) as $value) : ?>

                                <div class="admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center write-access" id="admin-cart-<?= $value['username'] ?>">
                                    <div class="overally <?php if ($_SESSION['permission'] == Permission::$read) echo "hidden"; ?>">
                                        <div class="container p-3 h-100">
                                            <div class="d-flex flex-column justify-content-around h-75">
                                                <h2> Edit Admin </h2>

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
                        <!-- end card body -->

                    </div>
                </div>
            </div>

            <!-- end according -->
        </div>


    </main>

    <footer>

    </footer>
</body>

</html>