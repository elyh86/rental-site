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
    <title><?= isset($page_title) ? $page_title . ' - Rydr' : 'Rydr - Professionele Autoverhuur' ?></title>
    <meta name="description" content="<?= isset($page_description) ? $page_description : 'Huur een auto bij Rydr. Professionele autoverhuur voor particulieren en bedrijven. Ruime selectie auto\'s, scherpe prijzen en uitstekende service.' ?>">
    <meta name="keywords" content="autoverhuur, auto huren, bedrijfswagen, huurauto, Rydr, mobiliteit">
    <meta name="author" content="Rydr">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?= isset($page_title) ? $page_title . ' - Rydr' : 'Rydr - Professionele Autoverhuur' ?>">
    <meta property="og:description" content="<?= isset($page_description) ? $page_description : 'Huur een auto bij Rydr. Professionele autoverhuur voor particulieren en bedrijven.' ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:image" content="/assets/images/logo.png">
    <meta property="og:site_name" content="Rydr">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= isset($page_title) ? $page_title . ' - Rydr' : 'Rydr - Professionele Autoverhuur' ?>">
    <meta name="twitter:description" content="<?= isset($page_description) ? $page_description : 'Huur een auto bij Rydr. Professionele autoverhuur voor particulieren en bedrijven.' ?>">
    <meta name="twitter:image" content="/assets/images/logo.png">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon.png">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/reservation.css">
    <link rel="stylesheet" href="/assets/css/dropdown.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Rydr",
        "url": "https://<?= $_SERVER['HTTP_HOST'] ?>",
        "logo": "https://<?= $_SERVER['HTTP_HOST'] ?>/assets/images/logo.png",
        "description": "Professionele autoverhuur voor particulieren en bedrijven",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Rotterdam",
            "addressCountry": "NL"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service"
        },
        "sameAs": [
            "https://www.facebook.com/rydr",
            "https://www.linkedin.com/company/rydr"
        ]
    }
    </script>
</head>
<body>
<div class="topbar">
    <div class="logo">
        <a href="/">
            Rydr.
        </a>
    </div>
    <form action="/ons-aanbod" method="get" class="search-form">
        <span class="search-icon">
            <i class="fa fa-search"></i>
        </span>
        <input type="text" name="q" placeholder="Search something here" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" class="search-input">
        <button type="button" class="filter-btn" title="Filter">
            <i class="fa fa-sliders-h"></i>
        </button>
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
                    <?php 
                    // Add admin link for admin users
                    $admin_emails = ['admin@example.com', 'admin@rydr.nl', 'lllk@gmail.com'];
                    if (in_array($_SESSION['email'], $admin_emails)): 
                    ?>
                    <li><img src="/assets/images/icons/setting.svg" alt=""><a href="/admin">Admin Dashboard</a></li>
                    <?php endif; ?>
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
