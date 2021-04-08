<?php

session_start();

$_SESSION['user'] = null;

header("location: /public/user/login.php");
