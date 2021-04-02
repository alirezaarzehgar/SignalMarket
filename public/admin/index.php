<?php
session_start();

$_SESSION['admin'] = $_COOKIE['admin'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    setcookie(
        "admin",
        $_POST['username'],
        time() + (50 * 50 * 24 * 100)
    );

    $_SESSION['admin'] = $_POST['username'];
    echo "cookie admin crated : " . $_COOKIE['admin'];
    header("location: /public/admin");
}

if (!isset($_COOKIE['admin']))
    header("location: /public/admin/admin-login.php");

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
    <link rel="stylesheet" href="../View/css/admin.css">
</head>

<body>

    <header class="container-fluid">

    </header>

    <main>

    </main>

    <footer>

    </footer>

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../View/js/admin.js"></script>
</body>

</html>