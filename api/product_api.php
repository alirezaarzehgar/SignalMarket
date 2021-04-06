<?php

require_once __DIR__ . '/../src/php/Common/auth.php';
require_once __DIR__ . '/../src/php/Controller/Repo/ProductsRepository.php';


$repo = new ProductsRepository();

if (
    $_POST['req'] == "delete" and
    isset($_POST['id'])
) {
    auth();
    $subject = $repo->getProductById($_POST['id'])['subject'];

    $imgePath = __DIR__ . '/../assets/photo_dir_path/' .  md5($subject . $_SESSION['admin']) . $repo->getProductById($_POST['id'])['photo_dir_path'];
    unlink($imgePath);

    $result = $repo->deleteProductById($_POST['id']);

    if ($result) {
        echo '{"status": 200}';
    } else {
        echo '{"status": 404}';
    }
}


if (
    $_POST['req'] == "accept" and
    isset($_POST['id'])
) {
    auth();

    $date = $_POST['date'];
    $price = $_POST['price'];

    $result = $repo->updateProductChooseAdminByAdmin(
        price: $price,
        accepted_date: $date,
        id: $_POST['id']
    );

    if ($result) {
        echo '{"status": 200}';
    } else {
        echo '{"status": 404}';
    }
}
