<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="ISO-8859-1">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rydr</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="icon" type="image/png" href="assets/images/favicon.ico" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body>
<div class="topbar">
    <div class="logo">
        <a href="/">
            Rydr.
        </a>
    </div>
    <form action="">
        <input type="search" name="" id="" placeholder="Welke auto wilt u huren?">
        <img src="assets/images/icons/search-normal.svg" alt="" class="search-icon">
    </form>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/ons-aanbod">Ons aanbod</a></li>
            <li><a href="#">Hulp nodig?</a></li>
        </ul>
    </nav>
    <div class="menu">
        <?php if(isset($_SESSION['id'])){ ?>
        <div class="account">
            <img src="assets/images/profil.png" alt="">
            <div class="account-dropdown">
                <ul>
                    <li><img src="assets/images/icons/setting.svg" alt=""><a href="#">Naar account</a></li>
                    <li><img src="assets/images/icons/logout.svg" alt=""><a href="/logout">Uitloggen</a></li>
                </ul>
            </div>
        </div>
        <?php }else{ ?>
            <a href="" class="button-primary">Start met huren</a>
        <?php } ?>

    </div>
</div>
<div class="content">
