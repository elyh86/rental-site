<?php
require_once __DIR__ . "/../database/connection.php";
require_once __DIR__ . "/auth.php";

// Check authentication status
checkAuth();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="ISO-8859-1">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rydr</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/auth.css">
    <link rel="stylesheet" href="/assets/css/account.css">
    <link rel="stylesheet" href="/assets/css/search.css">
    <link rel="icon" type="image/png" href="assets/images/favicon.ico" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <script>window.isLoggedIn = <?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>;</script>
</head>
<body>
<div class="topbar">
    <div class="logo">
        <a href="/">
            Rydr.
        </a>
    </div>
    <form action="/actions/search.php" method="GET" class="search-form">
        <input type="search" name="q" id="search" placeholder="Welke auto wilt u huren? (merk, model, type)" required>
        <button type="submit" class="search-button">
            <img src="assets/images/icons/search-normal.svg" alt="Zoeken" class="search-icon">
        </button>
    </form>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/ons-aanbod">Ons aanbod</a></li>
            <li><a href="/hulp-nodig">Hulp nodig?</a></li>
        </ul>
    </nav>
    <div class="menu">
        <?php if(isset($_SESSION['user_id'])){ ?>
        <div class="account">
            <img src="assets/images/profil.png" alt="">
            <div class="account-dropdown">
                <ul>
                    <li><img src="assets/images/icons/setting.svg" alt=""><a href="/account">Naar account</a></li>
                    <li><img src="assets/images/icons/car.svg" alt=""><a href="/mijn-huurautos">Mijn gehuurde auto's</a></li>
                    <li><img src="assets/images/icons/logout.svg" alt=""><a href="/logout">Uitloggen</a></li>
                </ul>
            </div>
        </div>
        <?php }else{ ?>
            <a href="/login-form" class="button-secondary">Inloggen</a>
            <a href="/register-form" class="button-primary">Registreren</a>
        <?php } ?>

    </div>
</div>
<div class="content">
