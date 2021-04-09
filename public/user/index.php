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
    <link rel="stylesheet" href="/public/View/css/user.css">
</head>

<body class="d-flex flex-column align-items-stretch">

    <header>
        <div class="navbar navbar-expand-sm bg-dark" id="topNavbar">
            <?php if (!isset($_SESSION['user'])) : ?>
                <a class="nav-item p-4" href="/public/user/login.php">Login</a>
                <a class="nav-item p-4" href="/public/user/signup.php">SignUp</a>
            <?php else : ?>
                <a class="nav-item p-4" href="/public/user/logout.php">Logout</a>
            <?php endif ?>
        </div>
    </header>

    <main class="container-fluid flex-grow-1">
        <div id="according">

            <!-- choosing a product -->
            <div class="card">
                <div class="card-header text-center">
                    <a href="#choosing_a_product" data-toggle="collapse" class="card-link">choosing a product</a>
                </div>

                <div id="choosing_a_product" class="collapse show" data-parent="#according">
                    <div class="card-body">
                        <div class="container-fluid p-5 d-flex flex-wrap">
                            <?php include __DIR__ . '/../View/php/user/choosingProduct.php'; ?>
                            <!-- card body -->
                            <!-- end card body -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- payment -->
            <div class="card">
                <div class="card-header text-center">
                    <a href="#payment" data-toggle="collapse" class="card-link">payment</a>
                </div>

                <div id="payment" class="collapse" data-parent="#according">
                    <div class="card-body">

                        <div class="container-fluid p-5 d-flex flex-wrap">
                            <!-- card body -->
                            <?php include __DIR__ . '/../View/php/user/payment.php'; ?>
                            <!-- end card body -->
                        </div>

                    </div>
                </div>
            </div>

            <?php if (isset($_SESSION['user'])) : ?>

                <!-- my products -->
                <div class="card">
                    <div class="card-header text-center">
                        <a href="#my-product" data-toggle="collapse" class="card-link">my products</a>
                    </div>

                    <div id="my-product" class="collapse" data-parent="#according">
                        <div class="card-body">

                            <div class="container-fluid p-5 d-flex flex-wrap">
                                <!-- card body -->
                                <?php include __DIR__ . '/../View/php/user/myProducts.php'; ?>
                                <!-- end card body -->
                            </div>

                        </div>
                    </div>
                </div>

            <?php endif ?>

            <!-- end according -->
        </div>

    </main>

    <footer class="bg-dark">
        <?php include __DIR__ . '/../View/php/common/footer.php'; ?>
    </footer>

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/public/View/js/index.js"></script>
</body>

</html>