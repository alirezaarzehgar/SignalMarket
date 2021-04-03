<?php

require_once __DIR__ . '/../src/php/Controller/Repo/AdminsRepository.php';


$repo = new AdminsRepository();

// search to usernames
if ($_GET['req'] == 'search in usernames' and isset($_GET['username'])) {
    $user = $repo->getAdminByUsername($_GET['username']);

    if (!empty($user))
        echo '{"status": 200}';
    else
        echo '{"status": 404}';
}

// search to passwords
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


// update admin
if (
    $_GET['req'] == 'update' and
    isset($_GET['username'])
) {
    $username = $_GET['username'];
    $id = $repo->getAdminByUsername($username)['id'];
    $password = null;
    if (!empty($_GET['password']))
        $password = $_GET['password'];

    $admin = new AdminsModel(
        username: $username,
        password: $password,
        permission: $_GET['permission']
    );

    $reult = $repo->updateAdmin(
        admin: $admin,
        id: $id
    );

    if ($reult)
        echo '{"status": 200,
            "permission": ' . $_GET['permission'] . '}';
    else
        echo '{"status": 404}';
}
