<?php

session_start();

if (isset($_SESSION['user']))
    header("location: /public/user");


require_once __DIR__ . '/../../src/php/Controller/Repo/UsersRepository.php';
require_once __DIR__ . '/../../src/php/Common/Hashing.php';


$repo = new UsersRepository();

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' and
    isset($_POST['username']) and
    isset($_POST['password']) and
    isset($_POST['email'])
) {

    $username = $_POST['username'];
    $passwd = $_POST['password'];
    $email = $_POST['email'];

    $user = $repo->getUserByUsername($username);

    // validation
    if (
        $user['email'] != $email or
        $user['password'] != Hashing::encrypt($passwd)
    )
        $invalidInfo = true;
    else {
        $_SESSION['user'] = $_POST['username'];
        header("location: /public/user");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../View/css/admin-login.css">
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
            <form class="p-5 d-flex flex-column" action="/public/user/login.php" method="POST">
                <h1 class="text-center text-white mb-5">Login</h1>

                <?php if (isset($invalidInfo)) : ?>
                    <p class="text-danger text-center"> invalid email&username or password </p>
                <?php endif ?>

                <input class="m-1" type="text" name="username" id="username" placeholder="Enter username" autocomplete="off" require>
                <p class="text-white ml-5" id="username-finished"></p>

                <input class="m-1" type="email" name="email" id="email" placeholder="Enter email" autocomplete="off" disabled require>
                <p class="text-white ml-5" id="email-finished"><?= $message ?></p>

                <input class="m-1" type="password" name="password" id="password" placeholder="Enter password" autocomplete="off" disabled require>

                <button class="m-1 btn btn-secondary text-center" id="submit" disabled>Login</button>
            </form>
        </main>
    </div>



    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../View/js/user-login.js"></script>
</body>

</html>