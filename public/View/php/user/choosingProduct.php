<?php

require_once __DIR__ . '/../../../../src/php/Controller/Repo/ProductsRepository.php';
require_once __DIR__ . '/../../../../src/php/Controller/Repo/AdminsRepository.php';
require_once __DIR__ . '/../../../../src/php/Controller/AdminsController.php';

$dirStorage = __DIR__ . '/../../../../assets/sent_signal_dir_path/';

$PRepo = new ProductsRepository();
$ARepo = new AdminsRepository();
$ACon = new AdminsController();

// handle file
if (
    isset($_FILES['sent_signal_dir_path']) and
    isset($_POST['expected_date']) and
    isset($_POST['id'])
) {
    if (!isset($_SESSION['user'])) {
        header("location: /public/user/login.php");
    }

    $err = $_FILES['sent_signal_dir_path']['error'];
    if ($err == 0) {
        move_uploaded_file(
            $_FILES['sent_signal_dir_path']['tmp_name'],
            $dirStorage . md5($_SESSION['user']) . $_FILES['sent_signal_dir_path']['name']
        );

        $PRepo->updateProductChooseCustomerByUser(
            sent_signal_dir_path: $_FILES['sent_signal_dir_path']['name'],
            customer_name: $_SESSION['user'],
            expected_date: $_POST['expected_date'],
            sent_date: date("Y-m-d"),
            id: $_POST['id']
        );
    }

    $doneMessage =  match ($err) {
        0 => "success",
        2 => "is too big to upload. (upload limit $uploadLimit)",
        4 => "no selected file",
        default => "sorry, there was a problem uploading " . $_FILES[$postArgFilename]['name'],
    };
}

?>

<link rel="stylesheet" href="/public/View/css/cart.css">
<script src="/public/View/js/choosing.js"></script>
<script src="/node_modules/jquery/dist/jquery.min.js"></script>

<?php $allAdmins = $ACon->read(); ?>

<?php while ($admin = $allAdmins->fetch_assoc()) : ?>

    <?php foreach ($PRepo->getProductsByAdminName($admin['username'] ?: "") as $value) : ?>
        <?php if ($value['choosen_by_customer']) continue; ?>

        <div class="admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center" id="admin-cart-<?= $value['id'] ?>">

            <div class="container-fluid mr-n4 mt-1">
                <img id="list-<?= $value['id'] ?>" class="admin-cart-img" src="/public/View/img/list-icon.png" alt="not found">
            </div>

            <h2 class="my-2"><?= $value['subject'] ?></h2>
            <img class="my-3 img-fluid" src="/assets/photo_dir_path/<?= md5(htmlentities($value['subject']) . $admin['username']) . $value['photo_dir_path'] ?>">

            <span class="overflow-auto"><?= $value['introduction_to_product'] ?></span>

            <div id="overally-<?= $value['id'] ?>" class="overally <?php if (!isset($_SESSION['user'])) echo "hidden"; ?>">
                <div class="container p-3 h-100">
                    <form class="d-flex flex-column justify-content-around h-75" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                        <h3 class="text-white"> Choosing a product </h3>

                        <input class="text-white" type="file" name="sent_signal_dir_path" id="sent_signal_dir_path">
                        <input type="date" name="expected_date" id="date-<?= $value['id'] ?>" value="<?= date("Y-m-d") ?>">
                        <input type="hidden" name="id" id="id" value="<?= $value['id'] ?>">

                        <button class="m-1 btn btn-secondary text-center" id="delete-<?= $value['id'] ?>" onclick="chooseAProduct('<?= $value['id'] ?>')">Submit</button>

                    </form>
                </div>
            </div>

            <script>
                handleUIOverally(<?= $value['id'] ?>);
            </script>

        </div>

    <?php endforeach ?>
<?php endwhile ?>