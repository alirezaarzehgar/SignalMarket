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

// search to usernames
if (
    $_GET['req'] == 'search in usernames' and
    isset($_GET['username'])
) {
    $user = $repo->getUserByUsername($_GET['username']);

    if (!empty($user))
        echo '{"status": 200}';
    else
        echo '{"status": 404}';
}

// search to emails
if (
    $_GET['req'] == 'search in emails' and
    isset($_GET['email'])
) {
    $user = $repo->getUserByEmail($_GET['email']);

    if (!empty($user))
        echo '{"status": 200}';
    else
        echo '{"status": 404}';
}
