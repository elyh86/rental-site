<?php

/**
 * Dit bestand is een héél belangrijk bestand van je applicatie.
 * Alle websitebezoeken komen eerst binnen via deze index.php.
 * Dit bestand gaat vervolgens kijken voor welke pagina de bezoeker komt.
 *
 * Stel: een bezoeker komt binnen op localhost/rental/auto-huren,
 * dan zoekt dit bestand in de 'pages'-folder het bestand auto-huren.php.
 *
 * Waarom doen we dit?
 *  - We krijgen er mooiere URL’s door (auto-huren in plaats van auto-huren.php).
 *  - We kunnen hier één keer logica schrijven voor “wat als de pagina niet bestaat”.
 *  - (Buiten het niveau van dit project) We kunnen ook hier logica toevoegen
 *    om te controleren of iemand is ingelogd, in plaats van dat per pagina te herhalen.
 *
 * Deze manier van je verzoeken afhandelen heet zogenaamd de 'front-controller pattern' en dit is daar een eenvoudige versie van.
 *
 *  Deze comment mág je verwijderen nadat je het hebt gelezen.
 */


$requestUri = $_SERVER['REQUEST_URI'];
$path = trim(parse_url($requestUri, PHP_URL_PATH), '/');

if ($path === 'logout') {
    require_once __DIR__ . '/actions/logout.php';
    exit;
}

if ($path === 'login-handler') {
    require_once __DIR__ . '/actions/login.php';
    exit;
}

if ($path === 'register-handler') {
    require_once __DIR__ . '/actions/register.php';
    exit;
}

$page = $path ?: 'home';
$file = __DIR__ . '/pages/' . $page . '.php';

if (file_exists($file)) {
    include $file;
} else {
    http_response_code(404);
    include __DIR__ . '/pages/404.php';
}
