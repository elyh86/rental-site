<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connectie voor profielfoto
require_once __DIR__ . "/../database/connection.php";
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
    <link rel="stylesheet" href="/assets/css/reservation.css">
    <link rel="stylesheet" href="/assets/css/dropdown.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <link rel="icon" type="image/png" href="/assets/images/favicon.ico" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="topbar">
    <div class="logo">
        <a href="/">
            Rydr.
        </a>
    </div>
    <form action="/ons-aanbod" method="get" class="search-form">
        <input type="text" name="q" placeholder="Zoek auto's..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" class="search-input">
        <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
        <?php 
        // Als er filters zijn geselecteerd, behoud deze in de zoekopdracht
        if (isset($_GET['filters']) && is_array($_GET['filters'])) {
            foreach ($_GET['filters'] as $filter) {
                echo "<input type='hidden' name='filters[]' value='" . htmlspecialchars($filter) . "'>";
            }
        }
        // Behoud type filter als die aanwezig is
        if (isset($_GET['type'])) {
            echo "<input type='hidden' name='type' value='" . htmlspecialchars($_GET['type']) . "'>";
        }
        ?>
    </form>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/ons-aanbod">Ons aanbod</a></li>
            <li><a href="/hulp">Hulp nodig?</a></li>
        </ul>
    </nav>
    <div class="menu">
        <?php if(isset($_SESSION['id'])){ 
            // Haal gebruikersgegevens op voor profielfoto
            $profile_stmt = $conn->prepare("SELECT profile_image FROM account WHERE id = :id");
            $profile_stmt->bindParam(":id", $_SESSION['id']);
            $profile_stmt->execute();
            $profile_data = $profile_stmt->fetch(PDO::FETCH_ASSOC);
            $profile_image = !empty($profile_data['profile_image']) ? '/' . $profile_data['profile_image'] : '/assets/images/profil.png';
        ?>
        <div class="account">
            <img src="<?= $profile_image ?>" alt="">
            <div class="account-dropdown">
                <ul>
                    <li><img src="/assets/images/icons/setting.svg" alt=""><a href="/account">Naar account</a></li>
                    <li><img src="/assets/images/icons/car.svg" alt=""><a href="/my-reservations">Mijn reserveringen</a></li>
                    <li><img src="/assets/images/icons/logout.svg" alt=""><a href="/logout">Uitloggen</a></li>
                </ul>
            </div>
        </div>
        <?php }else{ ?>
            <a href="/register-form" class="button-primary">Start met huren</a>
        <?php } ?>

    </div>
</div>
<div class="content">
