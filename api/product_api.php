<?php

require_once __DIR__ . '/../src/php/Common/auth.php';
require_once __DIR__ . '/../src/php/Controller/Repo/ProductsRepository.php';


$repo = new ProductsRepository();

if (
    $_POST['req'] == "delete" and
    isset($_POST['id'])
) {
    auth();

    $result = $repo->deleteProductById($_POST['id']);

    if ($result) {
        echo '{"status": 200}';
    } else {
        echo '{"status": 404}';
    }
}
