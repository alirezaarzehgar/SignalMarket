<?php

session_start();

if (isset($_SESSION['admin'])) {
    header("location: /public/admin/");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/View/css/public.css">
</head>

<body>

    <header>
        <div class="navbar navbar-expand-sm bg-dark" id="topNavbar">
            <?php if (!isset($_SESSION['admin'])) : ?>
                <a class="nav-item p-4" href="#">Login</a>
                <a class="nav-item p-4" href="#">SignUp</a>
            <?php else : ?>
                <a class="nav-item p-4" href="#">Logout</a>
            <?php endif ?>

        </div>
    </header>

    <main class="container">

    </main>

    <footer>

    </footer>

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/index.js"></script>
</body>

</html>