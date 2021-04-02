<?php

require_once __DIR__ . '/../../src/php/Controller/Repo/AdminsRepository.php';


$repo = new AdminsRepository();

session_start();

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' and
    isset($_POST['password'])
) {
    $admin = $repo->getAdminByUsername($_SESSION['admin']);
    $newAdmin = new AdminsModel(
        $admin['username'],
        $_POST['password'],
        $admin['permission']
    );

    $repo->updateAdmin($newAdmin, $admin['id']);

    header("location: /public/admin/index.php?request=logout");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/View/css/admin-login.css">
</head>

<body>

    <div class="hero">
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>

        <main class="container d-flex justify-content-center align-items-center">
            <form class="p-5 d-flex flex-column" action="/public/admin/edit-password.php" method="POST">
                <h1 class="text-center text-white mb-5">New Password</h1>
                <h4 class="text-center text-white border p-2"><?= $_SESSION['admin'] ?></h4>

                <input class="m-1" type="password" name="password" id="password" placeholder="Enter new password" autocomplete="off">
                <p class="text-white ml-3" id="password-finished"></p>

                <button class="m-1 btn btn-secondary text-center" id="submit" disabled>Register</button>
            </form>
        </main>
    </div>



    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/admin-edit-password.js"></script>
</body>

</html>