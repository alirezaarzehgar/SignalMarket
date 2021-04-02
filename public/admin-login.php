<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="View/css/admin-login.css">
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
            <form class="p-5 d-flex flex-column" action="admin.php" method="POST">
                <h1 class="text-center text-white mb-5">Login</h1>
                <input class="m-1" type="text" name="username" id="username" placeholder="Enter username" autocomplete="off">
                <p class="text-white ml-3" id="username-finished"></p>

                <input class="m-1" type="password" name="password" id="password" placeholder="Enter password" autocomplete="off" disabled>
                <p class="text-white ml-3" id="password-finished"></p>

                <button class="m-1 btn btn-secondary text-center" id="submit" disabled>Login</button>
            </form>
        </main>
    </div>



    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="View/js/admin-login.js"></script>
</body>

</html>