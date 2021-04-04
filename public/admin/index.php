<?php

require_once __DIR__ . '/../../src/php/Controller/Repo/AdminsRepository.php';
require_once __DIR__ . '/../../src/php/Controller/Repo/ProductsRepository.php';

$fileDestonation = __DIR__ . '/../../assets/';
$postArgFilename = 'photo_dir_path';
$uploadLimit = "2G";


$ARepo = new AdminsRepository();
$PRepo = new ProductsRepository();

session_start();

$_SESSION['admin'] = $_COOKIE['admin'];

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' and
    isset($_POST['username'])
) {
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
    isset($_GET['request']) and
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


// handle file uploaded
if (
    $_SERVER['REQUEST_METHOD'] == "POST" and
    isset($_POST['upload'])
) {
    try {
        $err = $_FILES[$postArgFilename]['error'];
        if ($err == 0) {
            move_uploaded_file(
                $_FILES[$postArgFilename]['tmp_name'],
                $fileDestonation . $_FILES[$postArgFilename]['name']
            );
        }

        $doneMessage =  match ($err) {
            0 => "success",
            2 => "is too big to upload. (upload limit $uploadLimit)",
            4 => "no selected file",
            default => "sorry, there was a problem uploading " . $_FILES[$postArgFilename]['name'],
        };
    } catch (Exception $e) {
        echo $e;
    }

    $PRepo->addNewProduct(
        admin_name: $_SESSION['admin'],
        subject: $_POST['subject'],
        photo_dir_path: $_FILES[$postArgFilename]['name'],
        introduction_to_product: $_POST['introduction_to_product']
    );
}
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
                                    <div class="overally">
                                        <div class="container p-3 h-100">

                                            <!-- form data -->
                                            <form class="d-flex flex-column justify-content-around h-100" action="/public/admin/index.php" enctype="multipart/form-data" method="POST">
                                                <h2> New Admin </h2>

                                                <input type="text" name="subject" id="subject" placeholder="Enter subject" onkeyup="onSubjectKeyUp()" autocomplete="off">
                                                <textarea class="border" name="introduction_to_product" id="introduction_to_product" cols="5" rows="5" onkeyup="onIntroductionToProductKeyUp()" disabled></textarea>
                                                <input class="btn m-1" type="file" name="photo_dir_path" id="photo_dir_path" value="choose your image" onclick="onChangePhotoDirPath()" name="submit" disabled>

                                                <button class="m-1 btn btn-secondary text-center" name="upload" id="new" onclick="onNewKeyUp()" disabled>Add</button>
                                            </form>
                                            <!-- form data -->

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

                                <div class="admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center write-access" id="admin-cart-<?= $value['id'] ?>">
                                    <div class="overally <?php if ($_SESSION['permission'] == Permission::$read) echo "hidden"; ?>">
                                        <div class="container p-3 h-100">
                                            <div class="d-flex flex-column justify-content-around h-75">
                                                <h2> Edit Admin </h2>

                                                <button class="m-1 btn btn-secondary text-center" id="delete-<?= $value['id'] ?>">Delete</button>

                                                <script>
                                                    registredHandleCarts('<?= $value['id'] ?>')
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