<?php
session_start();


function auth()
{
    if (
        !isset($_SESSION['admin']) or
        !isset($_SESSION['permission']) or
        $_SESSION['permission'] != 6
    ) {
        echo "خوب اومدی جلو XD";
        exit();
    }
}

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
