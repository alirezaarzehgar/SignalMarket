<?php

session_start();

if (isset($_SESSION['user']))
    header("location: /public/user");


require_once __DIR__ . '/../../src/php/Controller/Repo/UsersRepository.php';


$repo = new UsersRepository();
$invalidInfo = false;

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' and
    isset($_POST['username']) and
    isset($_POST['password']) and
    isset($_POST['email'])
) {
    $username = $_POST['username'];
    $passwd = $_POST['password'];
    $email = $_POST['email'];

    $userByUN = $repo->getUserByUsername($username);
    $userByEM = $repo->getUserByEmail($email);

    // validation
    if (
        isset($userByEM) or
        isset($userByUN)
    ) {
        $invalidInfo = true;
    } else {
        $invalidInfo = false;

        $user = new UsersModel(
            username: $username,
            email: $email,
            password: $passwd
        );

        $result = $repo->addNewUser($user);
        if (!$result)
            $invalidInfo = true;
        else {
            $_SESSION['user'] = $username;

            header("location: /public/user/login.php");
        }
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
            <form class="p-5 d-flex flex-column" action="/public/user/signup.php" method="POST">
                <h1 class="text-center text-white mb-5">Sign up</h1>

                <?php if ($invalidInfo) : ?>
                    <p class="text-danger text-center"> username or mail already exits </p>
                <?php endif ?>

                <input class="m-1" type="text" name="username" id="username" placeholder="Enter username" autocomplete="off" require>
                <p class="text-white ml-3" id="username-finished"></p>

                <input class="m-1" type="email" name="email" id="email" placeholder="Enter email" autocomplete="off" disabled require>
                <p class="text-white ml-3" id="email-finished"></p>

                <input class="m-1" type="password" name="password" id="password" placeholder="Enter password" autocomplete="off" disabled require>

                <button class="m-1 btn btn-secondary text-center" id="submit" disabled>Login</button>
            </form>
        </main>
    </div>



    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/user-signup.js"></script>
</body>

</html>