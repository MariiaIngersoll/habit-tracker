<?php

ini_set('session.use_only_cookies', 1); // Использовать ТОЛЬКО куки для хранения ID сессии. 1 - значит true
ini_set('session.use_strict_mode', 1); //PHP будет проверять, что ID сессии существует и действителен. Нельзя придумать свой ID


session_start();

if (!isset($_SESSION['last_regeneration'])) {

    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
} else {

    $interval = 60*30;

    if (time() - $_SESSION['last_regeneration'] >= $interval) {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}

