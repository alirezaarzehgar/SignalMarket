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
            <a class="nav-item p-4" href="#">Login</a>
            <a class="nav-item p-4" href="#">Logout</a>
            <a class="nav-item p-4" href="#">SignUp</a>

        </div>
    </header>

    <main class="container">
        <h1> this is the test responsive </h1>
        <p> i wanna create Scientific Market </p>
    </main>

    <footer>

    </footer>

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/index.js"></script>
</body>

</html>