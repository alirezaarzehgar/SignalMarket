<?php

require_once __DIR__ . '/../../../../src/php/Controller/Repo/ProductsRepository.php';
require_once __DIR__ . '/../../../../src/php/Controller/Repo/AdminsRepository.php';
require_once __DIR__ . '/../../../../src/php/Controller/AdminsController.php';

$dirStorage = __DIR__ . '/../../../../assets/sent_signal_dir_path/';

$PRepo = new ProductsRepository();
$ARepo = new AdminsRepository();
$ACon = new AdminsController();

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' and
    isset($_POST['price']) and
    isset($_POST['payment']) and
    isset($_POST['id'])
) {
    $PRepo->updateSuccessPaymentByUser(
        success_payment: true,
        id: $_POST['id']
    );
}
?>

<link rel="stylesheet" href="/public/View/css/cart.css">
<script src="/public/View/js/choosing.js"></script>
<script src="/node_modules/jquery/dist/jquery.min.js"></script>

<?php $allAdmins = $ACon->read(); ?>

<?php while ($admin = $allAdmins->fetch_assoc()) : ?>

    <?php foreach ($PRepo->getProductsByAdminName($admin['username'] ?: "") as $value) : ?>
        <?php if (
            !$value['choosen_by_customer'] ||
            !$value['choosen_by_admin'] ||
            $value['success_payment']
        ) continue; ?>

        <div class="admin-cart container border shadow m-5 text-center w-auto overflow-hidden d-flex flex-column align-items-center" id="admin-cart-<?= $value['id'] ?>">

            <div class="container-fluid mr-n4 mt-1">
                <img id="list-<?= $value['id'] ?>" class="admin-cart-img" src="/public/View/img/list-icon.png" alt="not found">
            </div>

            <h2 class="my-2"><?= $value['subject'] ?></h2>
            <img class="my-3 img-fluid" src="/assets/photo_dir_path/<?= md5(htmlentities($value['subject']) . $admin['username']) . $value['photo_dir_path'] ?>">

            <span class="overflow-auto flex-grow-1"><?= $value['introduction_to_product'] ?></span>

            <div id="overally-<?= $value['id'] ?>" class="overally <?php if (!isset($_SESSION['user'])) echo "hidden"; ?>">
                <div class="container p-3 h-100">
                    <form class="d-flex flex-column justify-content-around h-75" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                        <h3 class="text-white"> Choosing a product </h3>

                        <h6 class="text-center text-white border p-2">
                            <p><?= $value['sent_date'] ?></p>
                        </h6>

                        <h6 class="text-center text-white border p-2">
                            <p class="text-white"> <?= $value['price'] ?> </p>
                        </h6>
                        <input type="hidden" name="price" value="<?= $value['price'] ?>">
                        <input type="hidden" name="id" value="<?= $value['id'] ?>">

                        <button class="m-1 btn btn-secondary text-center" name="payment" id="payment-<?= $value['id'] ?>">Payment</button>

                    </form>
                </div>
            </div>

            <script>
                handleUIOverally(<?= $value['id'] ?>);
            </script>

        </div>

    <?php endforeach ?>
<?php endwhile ?>