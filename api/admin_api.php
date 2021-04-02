<?php

require_once __DIR__ . '/../src/php/Controller/Repo/AdminsRepository.php';


$repo = new AdminsRepository();

if ($_GET['req'] == 'search in usernames' and isset($_GET['username'])) {
    $user = $repo->getAdminByUsername($_GET['username']);

    if (!empty($user))
        echo '{"status": 200}';
    else
        echo '{"status": 404}';
}

if (
    $_GET['req'] == 'search in passwords' and
    isset($_GET['username']) and
    isset($_GET['password'])
) {
    $user = $repo->getAdminByUsername($_GET['username']);

    if (!empty($user) and $user['password'] == Hashing::encrypt($_GET['password']))
        echo '{"status": 200}';
    else
        echo '{"status": 404}';
}
