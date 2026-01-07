<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['habits'] = [];
    $_SESSION['message'] = 'Все привычки удалены!';
    $_SESSION['message_type'] = 'success';
}

header('Location: index.php');
exit;
?>