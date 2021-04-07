<?php

require_once __DIR__ . '/../../src/php/Controller/Repo/AdminsRepository.php';
require_once __DIR__ . '/../../src/php/Controller/Repo/ProductsRepository.php';

$fileDestonation = __DIR__ . '/../../assets/';
$postArgFilename = 'photo_dir_path';
$uploadLimit = "2G";


$ARepo = new AdminsRepository();
$PRepo = new ProductsRepository();

session_start();


if (!isset($_SESSION['admin']))
    header("location: /public/admin/admin-login.php");

// calculate admin permission
$permission = $ARepo->getAdminByUsername($_SESSION['admin'])['permission'];
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
                $fileDestonation . '/photo_dir_path/' . md5(htmlentities($_POST['subject']) . $_SESSION['admin']) . $_FILES[$postArgFilename]['name']
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
        subject: htmlentities($_POST['subject']),
        photo_dir_path: htmlentities($_FILES[$postArgFilename]['name']),
        introduction_to_product: htmlentities($_POST['introduction_to_product'])
    );
}

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' and
    isset($_POST['uploaded-final'])
) {
    try {
        $err = $_FILES['final-file']['error'];
        if ($err == 0) {
            move_uploaded_file(
                $_FILES['final-file']['tmp_name'],
                $fileDestonation . '/finals/' . md5(htmlentities($_POST['subject']) . $_SESSION['admin']) . $_FILES['final-file']['name']
            );
        }

        $doneMessage =  match ($err) {
            0 => "success",
            2 => "is too big to upload. (upload limit $uploadLimit)",
            4 => "no selected file",
            default => "sorry, there was a problem uploading " . $_FILES['final-file']['name'],
        };
    } catch (Exception $e) {
        echo $e;
    }

    $prod = new ProductsModel(
        final_product_path: $_FILES['final-file']['name']
    );

    $PRepo->updateProduct(
        $prod,
        $_POST['id']
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/admin.js"></script>

</head>

<body>

    <header class="container-fluid">
        <div class="container d-flex flex-row p-3 ">
            <h3 class="p-1 mr-2 ml-n1 text-white">Signal Marketing</h3>

            <p class="flex-grow-1"></p>

            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><?= $_SESSION['admin'] ?></button>
                <ul class="dropdown-menu">
                    <li><a href="/public/admin/edit-password.php">Edit Password</a></li>
                    <li><a href="/public/admin/see-users.php">See users</a></li>

                    <?php if ($permission == Permission::$read) : ?>
                        <li><a href="/public/admin/add-and-edit-admins.php">see another admins</a></li>
                    <?php elseif ($permission == Permission::$write) : ?>
                        <li><a href="/public/admin/add-and-edit-admins.php">Add & Edit & Delete another admins</a></li>
                    <?php endif ?>

                    <li><a href="/public/admin/admin-login.php?request=logout">Logout</a></li>
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

                        <!-- card body -->
                        <div class="container-fluid p-5 d-flex flex-wrap">
                            <?php foreach ($PRepo->getProductsByAdminName($_SESSION['admin']) as $value) : ?>
                                <?php if (
                                    !$value['choosen_by_customer'] ||
                                    !$value['choosen_by_admin'] ||
                                    !$value['success_payment'] ||
                                    $value['final_product_path']
                                ) continue; ?>


                                <div class="overflow-auto admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center" id="admin-cart-<?= $value['id'] ?>">

                                    <div class="container-fluid mr-n4 mt-1">
                                        <img id="list-<?= $value['id'] ?>" class="admin-cart-img" src="/public/View/img/list-icon.png" alt="not found">
                                    </div>

                                    <h4 class="my-2"><?= $value['subject'] ?></h4>
                                    <img class="my-3 img-fluid" src="/assets/photo_dir_path/<?= md5($value['subject'] . $_SESSION['admin']) . $value[$postArgFilename] ?>" alt="/assets/photo_dir_path/<?= $value[$postArgFilename] ?>">
                                    <span class="overflow-auto h-50"> <?= $value['introduction_to_product'] ?> </span>

                                    <p><?= $value['price'] ?></p>

                                    <div id="overally-<?= $value['id'] ?>" class="overally <?php if ($_SESSION['permission'] == Permission::$read) echo "hidden"; ?>">
                                        <div class="container p-3 h-100">
                                            <form class="d-flex flex-column justify-content-around h-75" action="/public/admin/index.php" enctype="multipart/form-data" method="POST">
                                                <h2> Send Final File </h2>

                                                <input type="file" name="final-file" id="final-file-<?= $value['id'] ?>" required>
                                                <input type="hidden" name="id" value="<?= $value['id'] ?>">

                                                <button class="m-1 btn btn-secondary text-center" name="uploaded-final" id="delete-<?= $value['id'] ?>">send product</button>

                                            </form>
                                        </div>
                                    </div>

                                    <script>
                                        handleUIOverally(<?= $value['id'] ?>);
                                    </script>

                                </div>

                            <?php endforeach ?>
                        </div>
                        <!-- end card body -->


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

                        <!-- card body -->
                        <div class="container-fluid p-5 d-flex flex-wrap">
                            <?php foreach ($PRepo->getProductsByAdminName($_SESSION['admin']) as $value) : ?>
                                <?php if (!$value['choosen_by_customer'] || $value['choosen_by_admin']) continue; ?>

                                <div class="overflow-auto admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center" id="admin-cart-<?= $value['id'] ?>">

                                    <div class="container-fluid mr-n4 mt-1">
                                        <img id="list-<?= $value['id'] ?>" class="admin-cart-img" src="/public/View/img/list-icon.png" alt="not found">
                                    </div>

                                    <h4 class="my-2"><?= $value['subject'] ?></h4>
                                    <img class="my-3 img-fluid" src="/assets/photo_dir_path/<?= md5($value['subject'] . $_SESSION['admin']) . $value[$postArgFilename] ?>" alt="/assets/photo_dir_path/<?= $value[$postArgFilename] ?>">
                                    <span class="overflow-auto h-50"><?= $value['introduction_to_product'] ?></span>

                                    <div id="overally-<?= $value['id'] ?>" class="overally <?php if ($_SESSION['permission'] == Permission::$read) echo "hidden"; ?>">
                                        <div class="container p-3 h-100">
                                            <div class="d-flex flex-column justify-content-around h-75">
                                                <h2> Accept Price </h2>

                                                <h6 class="text-center text-white border p-2">
                                                    <a href="/assets/sent_signal_dir_path/<?= $value['sent_signal_dir_path'] ?>"><?= $value['sent_signal_dir_path'] ?></a>
                                                </h6>

                                                <input type="date" name="get-date" id="get-date-<?= $value['id'] ?>" value="<?= $value['expected_date'] ?>">
                                                <input type="text" name="get-price" id="get-price-<?= $value['id'] ?>" value="<?= $value['price'] ?>" placeholder="Enter your price">

                                                <button class="m-1 btn btn-secondary text-center" id="delete-<?= $value['id'] ?>" onclick="accetpProduct('<?= $value['id'] ?>')">Accept</button>

                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        handleUIOverally(<?= $value['id'] ?>);
                                    </script>

                                </div>

                            <?php endforeach ?>
                        </div>
                        <!-- end card body -->

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
                                <?php if ($value['choosen_by_customer']) continue; ?>

                                <div class="admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center" id="admin-cart-<?= $value['id'] ?>">

                                    <div class="container-fluid mr-n4 mt-1">
                                        <img id="list-<?= $value['id'] ?>" class="admin-cart-img" src="/public/View/img/list-icon.png" alt="not found">
                                    </div>

                                    <h2 class="my-2"><?= $value['subject'] ?></h2>
                                    <img class="my-3 img-fluid" src="/assets/photo_dir_path/<?= md5($value['subject'] . $_SESSION['admin']) . $value[$postArgFilename] ?>" alt="/assets/photo_dir_path/<?= $value[$postArgFilename] ?>">
                                    <span class="overflow-auto"><?= $value['introduction_to_product'] ?></span>

                                    <div id="overally-<?= $value['id'] ?>" class="overally <?php if ($_SESSION['permission'] == Permission::$read) echo "hidden"; ?>">
                                        <div class="container p-3 h-100">
                                            <div class="d-flex flex-column justify-content-around h-75">
                                                <h2> Delete Product </h2>

                                                <button class="m-1 btn btn-secondary text-center" id="delete-<?= $value['id'] ?>" onclick="deleteProduct('<?= $value['id'] ?>')">Delete</button>

                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        handleUIOverally(<?= $value['id'] ?>);
                                    </script>

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