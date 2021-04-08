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

    <!-- css files -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/View/css/admin.css">
    <link rel="stylesheet" href="/public/View/css/add-and-edit-admins.css">

    <!-- in this page i use js function between php code ... we sould include js libs on top of page. -->
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/add-and-edit-admins.js"></script>

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
            <div class="admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center justify-content-center <?php if ($_SESSION['permission'] == Permission::$write) echo "write-access"; ?>" id="admin-cart-<?= $value['username'] ?>">

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


            <?php foreach ($allAdmins as $value) : ?>

                <?php if ($value['username'] == $_SESSION['admin']) continue; ?>

                <?php $currentPerm = $repo->getAdminByUsername($value['username'])['permission'] ?>
                <?php $accessIntro = "" ?>
                <?php $topIcon = "" ?>

                <div class="admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center <?php if ($_SESSION['permission'] == Permission::$write) echo "write-access"; ?>" id="admin-cart-<?= $value['username'] ?>">
                    <?php if ($currentPerm == Permission::$read) : ?>
                        <?php $topIcon = "/public/View/img/read-access.png" ?>
                        <?php $accessIntro = "Just can see another admins." ?>
                    <?php elseif ($currentPerm == Permission::$write) : ?>
                        <?php $topIcon = "/public/View/img/write-access.png" ?>
                        <?php $accessIntro = "Super admin.<br>
                         He can: <br>
                         <ul>
                            <li>Create new admin</li>
                            <li>Edit exist admins</li>
                            <li>Delete exist admins</li>
                         </ul>" ?>
                    <?php else : ?>
                        <?php $topIcon = "/public/View/img/limited.png" ?>

                        <?php $accessIntro = "he has no access" ?>
                    <?php endif ?>

                    <img id="access-image-<?= $value['username'] ?>" class="m-2 mb-4" src="<?= $topIcon ?>" alt="write access">

                    <h1 class="flex-grow-1"><?= $value['username'] ?></h1>
                    <h6 class="text-left p-3" id="intro-<?= $value['username'] ?>"><?= $accessIntro ?></h6>

                    <div class="overally <?php if ($_SESSION['permission'] == Permission::$read) echo "hidden"; ?>">
                        <div class="container p-3 h-100">
                            <div class="d-flex flex-column justify-content-around h-100">
                                <h2> Edit Admin </h2>

                                <h4 class="text-center text-white border p-2"><?= $value['username'] ?></h4>
                                <div>
                                    <input class="m-1" type="password" name="password" id="password-<?= $value['username'] ?>" placeholder="Enter new password" autocomplete="off">
                                    <p class="text-white ml-3" id="password-finished-<?= $value['username'] ?>"></p>

                                    <select class="permission" id="permission-<?= $value['username'] ?>">
                                        <option value="0" <?php if ($value['permission'] == 0) echo "selected"; ?>>0</option>
                                        <option value="2" <?php if ($value['permission'] == 2) echo "selected"; ?>>2</option>
                                        <option value="6" <?php if ($value['permission'] == 6) echo "selected"; ?>>6</option>
                                    </select>
                                </div>

                                <button class="m-1 btn btn-secondary text-center" id="submit-<?= $value['username'] ?>">Update</button>
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