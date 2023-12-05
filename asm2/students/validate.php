<?php

session_start();

$_SESSION['error'] = [];

$code = $_POST["mssv"];
$name = $_POST["ten"];
$img = $_FILES["hinh"];

if (empty($code)) {
    $_SESSION['error']['mssv'] = "Code is required.";
} elseif (strlen($code) > 10) {
    $_SESSION['error']['mssv'] = "Code must be 10 characters or less.";
} else {
    unset($_SESSION['error']['mssv']);
}

if (empty($name)) {
    $_SESSION['error']['ten'] = "Name is required.";
} elseif (strlen($name) > 100) {
    $_SESSION['error']['ten'] = "Name must be 100 characters or less.";
} else {
    unset($_SESSION['error']['ten']);
}

if ($img['size'] > 2048000) { // 2048kb = 2MB
    $_SESSION['error']['hinh'] = "Image size must not exceed 2MB.";
} else {
    unset($_SESSION['error']['hinh']);
}

if (!empty($_SESSION['error'])) {
    header("Location: ../create.php");
    exit();
}