<?php

require_once __DIR__ . '/../src/php/Common/auth.php';
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

// update admin
if (
    $_GET['req'] == 'update' and
    isset($_GET['username'])
) {
    auth();

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

// delete admin
if (
    $_GET['req'] == 'delete' and
    isset($_GET['username'])
) {
    auth();

    $username = $_GET['username'];

    if (empty($repo->getAdminByUsername($username))) {
        echo '{"status": 404}';
        exit();
    }

    $result = $repo->deleteAdminByUsername($username);
    if ($result) {
        echo '{"status": 200}';
    } else {
        echo '{"status": 404}';
    }
}

// new admin
if (
    $_POST['req'] == 'new' and
    isset($_POST['username']) and
    isset($_POST['permission']) and
    isset($_POST['password'])
) {
    $username = $_POST['username'];
    $permission = $_POST['permission'];
    $password = $_POST['password'];

    $admin = new AdminsModel(
        username: $username,
        password: $password,
        permission: $permission
    );

    if (!empty($repo->getAdminByUsername($username))) {
        echo '{"status": 409, "message": "user already exists"}';
        exit();
    }

    $result = $repo->addNewAdmin($admin);
    if ($result) {
        echo '{"status": 200}';
    } else {
        echo '{"status": 404}';
    }
}
