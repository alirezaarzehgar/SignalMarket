<?php

require_once __DIR__ . '/../src/php/Common/auth.php';
require_once __DIR__ . '/../src/php/Controller/Repo/UsersRepository.php';


$repo = new UsersRepository();


// user admin
if (
    $_GET['req'] == 'delete' and
    isset($_GET['username'])
) {
    auth();

    $username = $_GET['username'];

    if (empty($repo->getUserByUsername($username))) {
        echo '{"status": 404}';
        exit();
    }

    $result = $repo->deleteUserByUsername($username);
    if ($result) {
        echo '{"status": 200}';
    } else {
        echo '{"status": 404}';
    }
}
