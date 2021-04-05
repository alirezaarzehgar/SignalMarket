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
